<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;
use App\Services\ForwardChainingService;
use App\Models\Consultation;
use App\Models\ConsultationDetail;
use App\Services\DecisionTreeService;

class ConsultationController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::whereIn('code', ['G01', 'G02', 'G04', 'G07', 'G08', 'G10', 'G11', 'G13', 'G15'])->get();
        return view('pages.konsultasi.index', compact('symptoms'));
    }

    public function followup(Request $request, DecisionTreeService $decisionTree)
    {
        $request->validate([
            'symptoms' => 'required|array|max:1'
        ]);

        $selected = $request->symptoms;
        session([
            'selected_symptoms' => $selected,
            'asked_symptoms' => [],
            'cf_user' => [
                $selected[0] => 1
            ],
            'history' => []
        ]);

        $symptom = $decisionTree->getNextSymptom($selected, []);
        if (!$symptom) {
            return redirect('/konsultasi/konfirmasi');
        }

        $progress = $decisionTree->getProgress($selected, []);

        return view('pages.konsultasi.followup', compact('symptom', 'progress'));
    }

    private function nextQuestion(DecisionTreeService $tree)
    {
        $selected = session('selected_symptoms', []);
        $asked = session('asked_symptoms', []);
        $next = $tree->getNextSymptom($selected, $asked);

        if (!$next) {
            return redirect('/konsultasi/konfirmasi');
        }

        $progress = $tree->getProgress($selected, $asked);

        return view('pages.konsultasi.followup', [
            'symptom' => $next,
            'progress' => $progress
        ]);
    }

    public function answer(Request $request, DecisionTreeService $tree)
    {
        $selected = session('selected_symptoms', []);
        $asked = session('asked_symptoms', []);
        $cf = session('cf_user', []);
        $code = $request->symptom;
        $asked[] = $code;

        if ($request->has == 1) {
            $selected[] = $code;
            $cf[$code] = (float) $request->cf;
        }

        $history = session('history', []);

        $history[] = [
            'symptom' => $code,
            'has' => (int) $request->has,
            'cf' => $request->has ? (float) $request->cf : 0,
        ];

        session([
            'selected_symptoms' => array_unique($selected),
            'asked_symptoms' => array_unique($asked),
            'cf_user' => $cf,
            'history' => $history
        ]);

        return $this->nextQuestion($tree);
    }

    public function confirmation(ForwardChainingService $forward)
    {
        $selected = session('selected_symptoms', []);
        $symptoms = Symptom::whereIn('code', $selected)->get();
        $results = $forward->diagnose(
            $selected,
            session('cf_user', [])
        );
        $topResult = $results[0] ?? null;
        $totalSymptoms = count($selected);
        $matchedCount = count($topResult['matched'] ?? []);
        return view('pages.konsultasi.konfirmasi', compact('symptoms', 'topResult', 'totalSymptoms', 'matchedCount'));
    }

    public function diagnose(Request $request, ForwardChainingService $forward)
    {
        $results = $forward->diagnose(
            $request->symptoms,
            session('cf_user', [])
        );

        if (empty($results)) {
            return back()->with('error', 'Belum ditemukan hasil.');
        }

        session(['last_result' => $results]);

        $symptoms = Symptom::whereIn('code', $request->symptoms)->get();

        return view('pages.konsultasi.hasil', compact('results', 'symptoms'));
    }

    public function back(DecisionTreeService $tree)
    {
        $history = session('history', []);

        if (empty($history)) {
            return redirect('/konsultasi');
        }

        $last = array_pop($history);

        $selected = session('selected_symptoms', []);
        $asked = session('asked_symptoms', []);
        $cf = session('cf_user', []);

        $code = $last['symptom'];

        // hapus dari pertanyaan yang sudah ditanyakan
        $asked = array_values(array_diff($asked, [$code]));

        // jika sebelumnya jawab Ya
        if ($last['has']) {
            $selected = array_values(array_diff($selected, [$code]));
            unset($cf[$code]);
        }

        session([
            'history' => $history,
            'selected_symptoms' => $selected,
            'asked_symptoms' => $asked,
            'cf_user' => $cf,
        ]);

        $progress = $tree->getProgress($selected, $asked);

        $symptom = Symptom::where('code', $code)->first();
        $oldAnswer = $last;

        return view('pages.konsultasi.followup', compact(
            'symptom',
            'progress',
            'oldAnswer'
        ));
    }

    public function store(Request $request)
    {
        $results = session('last_result', []);

        if (empty($results)) {
            return redirect('/konsultasi');
        }

        $main = $results[0];

        $alternatives = collect(array_slice($results, 1))
            ->map(function ($x) {
                return [
                    'name' => $x['diagnosis']['name'],
                    'score' => $x['percentage'],
                    'reason' => $x['reason']
                ];
            })
            ->values()
            ->toArray();

        $consultation = Consultation::create([
            'user_id' => auth()->id(),
            'diagnosis_id' => $main['diagnosis']['id'],
            'score' => $main['percentage'],
            'reason' => $main['reason'],
            'alternatives' => $alternatives
        ]);

        // AMBIL HANYA GEJALA USER
        $selected = session('selected_symptoms', []);
        $cf = session('cf_user', []);

        foreach ($selected as $code) {
            $symptom = Symptom::where('code', $code)->first();
            if ($symptom) {
                ConsultationDetail::create([
                    'consultation_id' => $consultation->id,
                    'symptom_id' => $symptom->id,
                    'cf_user' => $cf[$code] ?? 1
                ]);
            }
        }

        return redirect('/riwayat')->with('success', 'Riwayat berhasil disimpan');
    }

    public function history()
    {
        $consultations = auth()->user()->consultations()->with('diagnosis')->latest()->get();
        return view('pages.riwayat.index', compact('consultations'));
    }

    public function show($id)
    {
        $consultation = Consultation::with(['diagnosis', 'details.symptom'])->findOrFail($id);
        return view('pages.riwayat.detail', compact('consultation'));
    }
}

@extends('layouts.app')

@section('content')
  @php
    $diagnosis = $consultation->diagnosis;

    $score = round($consultation->score ?? 0);
    $status = $diagnosis->status ?? 'normal';

    $color = match ($status) {
        'normal' => '#22C55E',
        'perlu_kontrol' => '#EF4444',
        default => '#7E57C2',
    };

    $alternatives = $consultation->alternatives ?? [];

    if (is_string($alternatives)) {
        $alternatives = json_decode($alternatives, true) ?? [];
    }
  @endphp

  <div class="min-h-screen px-5 py-6 pb-28">
    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-6">
      <a href="/riwayat" class="w-10 h-10 rounded-full border border-[#E8E5F3] bg-white flex items-center justify-center">
        <span class="material-symbols-rounded">arrow_back_ios_new</span>
      </a>
      <div>
        <h1 class="text-[28px] font-bold text-[#2D2A4A]">Detail Riwayat</h1>
        <p class="text-sm text-[#7A7890]">Hasil konsultasi tersimpan</p>
      </div>
    </div>

    {{-- CARD HASIL --}}
    <div class="bg-white rounded-[18px] border border-[#E8E5F3] p-6">
      <h2 class="text-[30px] font-bold" style="color:{{ $color }}">{{ $consultation->diagnosis->name }}</h2>
      <p class="text-sm text-[#7A7890] mt-2">{{ $consultation->created_at->format('d M Y H:i') }}</p>
      <div class="mt-6">
        <div class="flex justify-between">
          <span class="text-[#7A7890]">Tingkat keyakinan</span>
          <b style="color:{{ $color }}">{{ $score }}%</b>
        </div>
        <div class="mt-3 h-3 rounded-full bg-[#F3F1FB] overflow-hidden">
          <div class="h-full rounded-full" style="width:{{ $score }}%;background:{{ $color }}"></div>
        </div>
      </div>
    </div>

    {{-- REKOMENDASI --}}
    <div class="mt-5 bg-white rounded-[18px] border border-[#E8E5F3] p-5">
      <h3 class="font-semibold text-[#2D2A4A]">Penanganan</h3>
      <div class="mt-3 text-sm leading-7 rounded-xl bg-[#F7F6FC] p-4">{{ $consultation->diagnosis->solution }}</div>
    </div>

    <div class="mt-5 bg-white rounded-[18px] border p-5">
      <h3 class="font-semibold text-[#2D2A4A]">
        Penjelasan Hasil Konsultasi
      </h3>

      <div class="space-y-4 mt-4">
        {{-- HOW --}}
        <div class="rounded-xl bg-[#F7F6FC] p-4">
          <div class="flex items-center gap-2">
            <span class="material-symbols-rounded text-[#7E57C2]">
              psychology
            </span>
            <h4 class="font-medium text-[#2D2A4A]">
              Bagaimana sistem memperoleh hasil ini?
            </h4>
          </div>

          <p class="text-[#5E5B77] text-sm leading-7 mt-3">
            Sistem membandingkan gejala yang Anda pilih dengan berbagai pola
            gejala pada basis pengetahuan. Dari proses tersebut ditemukan bahwa
            gejala yang Anda alami paling banyak sesuai dengan pola gejala
            <b>{{ $diagnosis->name }}</b>, sehingga kondisi ini menjadi
            kemungkinan dengan tingkat keyakinan tertinggi.
          </p>
        </div>

        {{-- WHY --}}
        <div class="rounded-xl bg-[#F7F6FC] p-4">
          <div class="flex items-center gap-2">
            <span class="material-symbols-rounded text-[#7E57C2]">
              help
            </span>
            <h4 class="font-medium text-[#2D2A4A]">
              Mengapa sistem menanyakan gejala tertentu?
            </h4>
          </div>

          <p class="text-[#5E5B77] text-sm leading-7 mt-3">
            Setiap pertanyaan yang diberikan bertujuan untuk mencari gejala
            tambahan yang dapat memperkuat atau mengurangi kemungkinan suatu
            kondisi kehamilan. Dengan mengetahui gejala yang dialami secara lebih
            lengkap, sistem dapat memberikan hasil konsultasi yang lebih sesuai
            dengan kondisi Anda.
          </p>
        </div>

        {{-- WHAT IF --}}
        <div class="rounded-xl bg-[#F7F6FC] p-4">
          <div class="flex items-center gap-2">
            <span class="material-symbols-rounded text-[#7E57C2]">
              rule
            </span>
            <h4 class="font-medium text-[#2D2A4A]">
              Mengapa kemungkinan lain tidak menjadi hasil utama?
            </h4>
          </div>

          <p class="text-[#5E5B77] text-sm leading-7 mt-3">
            Sistem juga menemukan beberapa kemungkinan kondisi lainnya.
            Namun, kondisi tersebut memiliki tingkat kecocokan yang lebih rendah
            karena tidak semua gejala pendukung terpenuhi atau jumlah gejala yang
            sesuai lebih sedikit dibandingkan
            <b>{{ $diagnosis->name }}</b>.
          </p>
        </div>

      </div>
    </div>

    {{-- KEMUNGKINAN LAIN --}}
    @if (!empty($alternatives))
      <div class="mt-5 bg-white rounded-[18px] border border-[#E8E5F3] p-5">
        <h3 class="font-semibold text-[#2D2A4A] mb-4">Kemungkinan Diagnosis Lain</h3>
        <div class="space-y-3">
          @foreach ($alternatives as $item)
            <details class="border rounded-xl p-4 border-[#E8E5F3]">
              <summary class="cursor-pointer list-none">
                <div class="flex items-center justify-between w-full">
                  <span class="font-medium text-[#2D2A4A]">{{ $item['name'] }}</span>
                  <div class="flex items-center gap-3">
                    <span
                      class="px-3 py-1 rounded-full bg-[#F3EEFF] text-[#7E57C2] text-sm font-semibold">{{ $item['score'] }}%</span>
                    <span class="material-symbols-rounded">expand_more</span>
                  </div>
                </div>
              </summary>
              <div class="mt-4">{{ $item['reason'] }}</div>
            </details>
          @endforeach
        </div>
      </div>
    @endif

    {{-- GEJALA --}}
    <div class="mt-5 bg-white rounded-[18px] border border-[#E8E5F3] p-5">
      <h3 class="font-semibold mb-4">Gejala yang dipilih pada saat konsultasi:</h3>
      <div class="space-y-3">
        @foreach ($consultation->details as $detail)
          <div class="flex gap-3">
            <span class="material-symbols-rounded text-[#7E57C2]">check_circle</span>
            {{ $detail->symptom->name }}
          </div>
        @endforeach
      </div>
    </div>

  </div>
@endsection

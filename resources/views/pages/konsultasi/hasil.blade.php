@extends('layouts.app')

@section('content')
  @php
    $main = $results[0];
    $diagnosis = $main['diagnosis'];
    $isNormal = strtolower($diagnosis->status) === 'normal';
    $color = $isNormal ? '#22C55E' : '#EF4444';

    if ($main['percentage'] >= 80) {
        $level = 'Sangat Tinggi';
    } elseif ($main['percentage'] >= 60) {
        $level = 'Tinggi';
    } elseif ($main['percentage'] >= 40) {
        $level = 'Sedang';
    } else {
        $level = 'Rendah';
    }

    $rule = \App\Models\Rule::where('diagnosis_id', $diagnosis->id)->first();

    $additionalSymptoms = collect();

    if ($rule) {
        $ruleSymptoms = explode(',', $rule->symptoms);

        $additionalCodes = array_diff($ruleSymptoms, $main['matched']);

        $additionalSymptoms = \App\Models\Symptom::whereIn('code', array_slice($additionalCodes, 0, 2))->get();
    }
  @endphp

  <div class="min-h-screen pb-28 px-5 py-6">
    {{-- TITLE --}}
    <div class="text-center mt-6">
      <p class="text-[#7A7890] text-sm">Hasil konsultasi menunjukkan kemungkinan tertinggi:</p>
      <h1 class="mt-2 text-[30px] font-bold" style="color:{{ $color }};">{{ $diagnosis->name }}</h1>
      <div class="mt-4 inline-flex px-5 py-2 border rounded-full font-semibold"
        style="background: {{ $isNormal ? '#E8FFF0' : '#FFF1F1' }}; color: {{ $color }};">
        {{ $main['percentage'] }}% Kecocokan
      </div>
    </div>

    {{-- BAR --}}
    <div class="mt-6 bg-white rounded-[18px] border p-5">
      <div class="flex justify-between items-center">
        <p class="text-sm text-[#7A7890]">
          Tingkat keyakinan hasil
        </p>

        <span class="font-semibold" style="color:{{ $color }}">
          {{ $level }}
        </span>
      </div>

      <div class="mt-3 h-3 rounded-full overflow-hidden bg-[#F3F1FB]">
        <div class="h-full rounded-full" style="width: {{ $main['percentage'] }}%; background: {{ $color }};">
        </div>
      </div>

      <div class="mt-4 grid grid-cols-2 gap-3">
        <div class="rounded-xl bg-[#F7F6FC] p-4">
          <p class="text-xs text-[#7A7890]">
            Certainty Factor
          </p>

          <p class="text-lg font-bold text-[#2D2A4A]">
            {{ number_format($main['cf'], 4) }}
          </p>
        </div>

        <div class="rounded-xl bg-[#F7F6FC] p-4">
          <p class="text-xs text-[#7A7890]">
            Persentase Kecocokan
          </p>

          <p class="text-lg font-bold" style="color:{{ $color }}">
            {{ $main['percentage'] }}%
          </p>
        </div>
      </div>
    </div>

    @if (count($main['matched']))
      <div class="mt-5 bg-white rounded-[18px] border p-5">
        <h3 class="font-semibold text-[#2D2A4A]">
          Gejala yang Mendukung Diagnosis
        </h3>

        <p class="mt-2 text-sm leading-7 text-[#7A7890]">
          Sistem menemukan
          <b>{{ count($main['matched']) }}</b>
          gejala yang sesuai dengan
          <b>{{ $diagnosis->name }}</b>.
        </p>

        {{-- Gejala yang dipilih dan cocok --}}
        <div class="space-y-3 mt-4">
          @foreach ($symptoms->whereIn('code', $main['matched']) as $symptom)
            <div class="flex items-center gap-3">
              <span class="material-symbols-rounded text-[#7E57C2]">
                check_circle
              </span>

              <span>
                {{ $symptom->name }}
              </span>
            </div>
          @endforeach
        </div>

        {{-- Tambahan 2 gejala lain --}}
        @if ($additionalSymptoms->count())
          <div class="mt-5 pt-5 border-t">
            <p class="text-sm text-[#7A7890] mb-3">
              Gejala lain yang sering berkaitan dengan
              <b>{{ $diagnosis->name }}</b>:
            </p>

            <div class="space-y-3">
              @foreach ($additionalSymptoms as $symptom)
                <div class="flex items-center gap-3">
                  <span class="material-symbols-rounded text-[#F59E0B]">
                    info
                  </span>

                  <span>
                    {{ $symptom->name }}
                  </span>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    @endif

    {{-- REKOMENDASI --}}
    <div class="mt-5 bg-white rounded-[18px] border p-5">
      <h3 class="font-semibold">Penanganan</h3>
      <div class="mt-3 text-sm leading-7 rounded-xl bg-[#F7F6FC] p-4">{{ $diagnosis->solution }}</div>
    </div>

    {{-- ALASAN --}}
    <div class="mt-5 bg-white rounded-[18px] border p-5">
      <h3 class="font-semibold text-[#2D2A4A]">Mengapa hasil ini muncul?</h3>
      <p class="mt-3 text-[#5E5B77] leading-7">
        {{ $main['reason'] }}
      </p>

      <div class="mt-4 text-[#5E5B77] leading-7 text-sm rounded-xl bg-[#F7F6FC] p-4">Berdasarkan <b>{{ count($main['matched']) }} gejala</b> yang sesuai,
        sistem menghitung tingkat keyakinan sebesar <b>{{ $main['percentage'] }}%</b> terhadap kemungkinan kondisi
        <b>{{ $diagnosis->name }}</b>.
      </div>
    </div>

    {{-- PENJELASAN HASIL --}}
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

    {{-- TOP LAIN --}}
    @if (count($results) > 1)
      <div class="mt-5 bg-white rounded-[18px] border p-5">
        <h3 class="font-semibold">Kemungkinan Lain</h3>
        <div class="mt-4 space-y-3">
          @foreach (array_slice($results, 1) as $item)
            <details class="rounded-xl border p-4">
              <summary class="cursor-pointer list-none">
                <div class="flex items-center justify-between w-full">
                  <span class="font-medium text-[#2D2A4A]">{{ $item['diagnosis']['name'] }}</span>
                  <div class="flex items-center gap-3">
                    <span
                      class="px-3 py-1 rounded-full bg-[#F3EEFF] text-[#7E57C2] text-sm font-semibold">{{ $item['percentage'] }}%</span>
                    <span class="material-symbols-rounded text-[#7E57C2]">expand_more</span>
                  </div>
                </div>
              </summary>
              <div class="mt-4">
                <p class="text-[#5E5B77] leading-7">{{ $item['reason'] }}</p>
                <div class="mt-3 text-sm leading-7 text-[#5E5B77] bg-[#F7F6FC] rounded-xl p-3"><strong>TIPS:</strong> {{ $item['diagnosis']['solution'] }}</div>
              </div>
            </details>
          @endforeach
        </div>
      </div>
    @endif

    {{-- GEJALA --}}
    <div class="mt-5 bg-white border rounded-[18px] p-5">
      <h3 class="font-semibold">Gejala yang dipilih pada saat konsultasi:</h3>
      <div class="space-y-3 mt-4">
        @foreach ($symptoms as $symptom)
          <div class="flex items-center gap-3">
            <span class="material-symbols-rounded text-[#7E57C2]">check_circle</span>
            {{ $symptom->name }}
          </div>
        @endforeach
      </div>
    </div>

    {{-- ACTION --}}
    <div class="grid grid-cols-3 gap-3 mt-6">
      <a href="/" id="homeBtn" class="h-[54px] border rounded-[14px] flex items-center justify-center gap-2">
        <span class="material-symbols-rounded">home</span>
        Home
      </a>

      <a href="/konsultasi" id="ulangBtn" class="h-[54px] border rounded-[14px] flex items-center justify-center gap-2">
        <span class="material-symbols-rounded">refresh</span>
        Ulang
      </a>

      <form method="POST" action="/konsultasi/simpan">
        @csrf
        <input type="hidden" name="diagnosis_id" value="{{ $results[0]['diagnosis']->id }}">
        <input type="hidden" name="score" value="{{ $results[0]['percentage'] }}">
        @foreach ($symptoms as $symptom)
          <input type="hidden" name="symptoms[]" value="{{ $symptom->code }}">
        @endforeach
        <button type="button" id="simpanBtn"
          class="h-[54px] w-full rounded-[14px] bg-[#7E57C2] text-white flex justify-center items-center gap-2">
          <span class="material-symbols-rounded">bookmark</span>
          Simpan
        </button>
      </form>
    </div>

  </div>

  <script>
    let isSaved = false

    // ULANG
    document.getElementById('ulangBtn')?.addEventListener('click', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'warning',
        title: 'Ulang Konsultasi?',
        text: 'Semua gejala akan dihapus dan konsultasi dimulai kembali.',
        showCancelButton: true,
        confirmButtonText: 'Ya, Ulang',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#7E57C2'
      }).then((r) => {
        if (r.isConfirmed) {
          isSaved = true
          window.location.href = '/konsultasi'
        }
      })
    })

    // HOME
    document.getElementById('homeBtn')?.addEventListener('click', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'question',
        title: 'Kembali ke Home?',
        text: 'Hasil konsultasi belum disimpan.',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tetap di sini',
        confirmButtonColor: '#7E57C2',
        cancelButtonColor: '#6B7280'
      }).then((r) => {
        if (r.isConfirmed) {
          isSaved = true
          window.location.href = '/'
        }
      })
    })

    // SIMPAN
    document.getElementById('simpanBtn')?.addEventListener('click', function(e) {
      e.preventDefault()

      Swal.fire({
        icon: 'question',
        title: 'Simpan hasil konsultasi?',
        text: 'Hasil diagnosis akan disimpan ke riwayat.',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#7E57C2',
        cancelButtonColor: '#6B7280'
      }).then((r) => {
        if (r.isConfirmed) {
          isSaved = true
          this.closest('form').submit()
        }
      })
    })

    // VALIDASI BOTTOM NAV
    document.addEventListener('DOMContentLoaded', () => {

      const navItems = document.querySelectorAll('nav a, footer a, .bottom-nav a')

      navItems.forEach(item => {

        item.addEventListener('click', function(e) {

          if (isSaved) return

          const href = this.getAttribute('href') || ''

          // JIKA MENU KONSULTASI
          if (
            href.includes('/konsultasi') &&
            !this.id.includes('ulangBtn')
          ) {
            e.preventDefault()

            Swal.fire({
              icon: 'info',
              title: 'Anda sedang ada di halaman konsultasi',
              text: 'Silakan simpan atau ulangi konsultasi terlebih dahulu.',
              confirmButtonText: 'Mengerti',
              confirmButtonColor: '#7E57C2'
            })

            return
          }

          // SKIP BUTTON SENDIRI
          if (
            this.id === 'homeBtn' ||
            this.id === 'ulangBtn' ||
            this.id === 'simpanBtn'
          ) {
            return
          }

          e.preventDefault()

          const targetUrl = this.href

          Swal.fire({
            icon: 'question',
            title: 'Pindah halaman?',
            text: 'Hasil konsultasi belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Tetap di sini',
            confirmButtonColor: '#7E57C2',
            cancelButtonColor: '#6B7280',
            reverseButtons: true
          }).then((result) => {

            if (result.isConfirmed) {
              isSaved = true
              window.location.href = targetUrl
            }

          })

        })

      })

    })
  </script>
@endsection

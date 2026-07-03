@extends('layouts.app')

@section('content')
  <div class="min-h-screen px-5 pt-6 pb-28">
    {{-- CARD KONSULTASI --}}
    <div class="bg-white border border-[#E8E5F3] rounded-[14px] p-5 mb-5">
      <div class="mb-3">
        <h2 class="text-[24px] font-bold text-[#2D2A4A]">
          Halo,
          {{ auth()->user()?->name ?? 'Bunda' }} 👋
        </h2>

        <p class="text-sm text-[#7A7890] mt-1">
          Apa yang ingin Anda lakukan hari ini?
        </p>
      </div>

      <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/hero.png') }}" class="w-[110px] h-[130px] rounded-[14px] object-cover shrink-0" />

        <div class="flex-1 border border-[#ECE8F7] rounded-[12px] p-4">
          <h3 class="text-[18px] font-semibold text-[#2D2A4A]">
            Mulai Konsultasi
          </h3>

          <p class="text-[13px] text-[#7A7890] mt-1">
            Jawab beberapa pertanyaan mengenai gejala yang Anda alami.
          </p>

          <a href="#" id="openConsultation"
            class="mt-3 h-[44px] rounded-[10px] bg-[#7E57C2] text-white font-medium flex items-center justify-center w-full transition hover:opacity-95">
            Mulai Sekarang
          </a>
        </div>
      </div>
    </div>

    <x-cards.menu-card href="/riwayat" icon="history" title="Riwayat Konsultasi"
      subtitle="Lihat hasil konsultasi sebelumnya" />

    <x-cards.menu-card href="/informasi" icon="water_drop" title="Informasi Kehamilan"
      subtitle="Artikel dan informasi seputar kehamilan" />

    <x-cards.menu-card href="/informasi" icon="favorite" title="Tips Kesehatan"
      subtitle="Tips menjaga kesehatan selama kehamilan" />
  </div>

  <script>
    document.getElementById('openConsultation').addEventListener('click', function(e) {
      e.preventDefault()

      Swal.fire({
        icon: 'question',
        title: 'Panduan Konsultasi',
        html: `
      <div style="text-align:left;line-height:1.6;color:#5E5B77;">

        <p style="margin-bottom:16px;">
          Konsultasi ini digunakan untuk membantu mengenali kondisi awal berdasarkan gejala yang dipilih.
        </p>

        <ol style="padding-left:18px;display:flex;flex-direction:column;gap:10px;margin:0;">

          <li>
            <b>Pilih gejala utama</b><br>
            <small>Pilih satu gejala yang paling Anda rasakan.</small>
          </li>

          <li>
            <b>Jawab pertanyaan lanjutan</b><br>
            <small>Sistem akan memberikan pertanyaan sesuai gejala.</small>
          </li>

          <li>
            <b>Lihat hasil diagnosis</b><br>
            <small>Lihat kemungkinan kondisi dan rekomendasi.</small>
          </li>

        </ol>

      </div>
    `,
        showCancelButton: true,
        confirmButtonText: 'Mulai Konsultasi',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#7E57C2',
        cancelButtonColor: '#FFFFFF',
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          const cancel = Swal.getCancelButton()
          cancel.style.color = '#2D2A4A'
          cancel.style.border = '1px solid #E8E5F3'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/konsultasi'
        }
      })
    })
  </script>
@endsection

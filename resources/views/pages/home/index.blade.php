@extends('layouts.app')

@section('content')
  <div class="min-h-screen px-5 pt-6">
    {{-- CARD KONSULTASI --}}
    <div class="bg-white border border-[#E8E5F3] rounded-2xl p-5 mb-5 shadow-[0_2px_8px_rgba(0,0,0,0.03)]">
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
        <img src="{{ asset('assets/images/hero.png') }}"
          class="w-[110px] h-[130px] rounded-[14px] object-cover shrink-0" />

        <div class="flex-1 bg-[#FAF8FF] border border-[#ECE8F7] rounded-[12px] p-4">
          <h3 class="text-[18px] font-semibold text-[#2D2A4A]">
            Mulai Konsultasi
          </h3>

          <p class="text-[13px] text-[#7A7890] mt-1">
            Jawab beberapa pertanyaan mengenai gejala yang Anda alami.
          </p>

          <a href="/konsultasi" class="mt-3 h-[44px] rounded-[10px] bg-[#7E57C2] text-white font-medium flex items-center justify-center w-full transition hover:opacity-95">
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
@endsection

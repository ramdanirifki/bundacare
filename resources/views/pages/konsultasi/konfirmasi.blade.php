@extends('layouts.app')

@section('content')
  <div class="min-h-[calc(100vh-96px)] pb-28 px-5 py-6">
    {{-- PROGRESS --}}
    <div class="mb-4">
      <div class="flex justify-between mb-2">
        <span class="text-sm text-[#7A7890]">
          Tingkat Kepastian Diagnosis
        </span>

        <span class="text-sm font-medium text-[#7E57C2]">
          {{ $topResult['percentage'] ?? 0 }}%
        </span>
      </div>

      <div class="h-3 bg-[#ECEAF5] rounded-full overflow-hidden">
        <div class="h-full bg-[#7E57C2] rounded-full transition-all duration-500"
          style="
        width:
        {{ $topResult['percentage'] ?? 0 }}%;
      ">
        </div>
      </div>

      <p class="text-xs text-[#7A7890] mt-2">
        Sistem hampir selesai menentukan hasil diagnosis.
      </p>
    </div>

    {{-- HEADER --}}
    <div class="flex items-center gap-3">
      <a href="/konsultasi/kembali" class="w-10 h-10 rounded-[14px] border border-[#E8E5F3] flex items-center justify-center">
        <span class="material-symbols-rounded">
          arrow_back_ios_new
        </span>
      </a>

      <div>
        <h1 class="text-[28px] font-bold">
          Konfirmasi
        </h1>
        <p class="text-sm text-[#7A7890]">
          Periksa kembali gejala yang dipilih.
        </p>
      </div>
    </div>

    {{-- @if ($topResult)
      <div class="mt-6 bg-[#F8F7FD] border rounded-[14px] p-5">
        <p class="text-xs text-violet-600 font-medium">Kandidat Diagnosis Sementara</p>
        <h3 class="text-lg font-bold text-[#2D2A4A] mt-1">{{ $topResult['diagnosis']->name }}</h3>
        <p class="text-sm text-[#7A7890] mt-2">Berdasarkan gejala yang telah dipilih, sistem menemukan kemungkinan kondisi
          yang cukup sesuai.</p>
      </div>
    @endif --}}

    <div class="mt-4 bg-[#F8F7FD] border rounded-[14px] p-4">
      <p class="text-sm text-[#5E5B77]">Sistem mendeteksi <b>{{ $totalSymptoms }} gejala</b> yang digunakan untuk
        menentukan hasil diagnosis.</p>
        @foreach ($symptoms as $symptom)
        <ul>
          <li class="flex items-center gap-2 mt-2">
            <span class="w-4 h-4 rounded-full bg-violet-600 flex justify-center items-center text-white text-[10px]">✓</span>
            <span class="text-sm text-[#5E5B77]">{{ $symptom->name }} ({{ $symptom->code }})</span>
          </li>
        </ul>
        @endforeach
    </div>

    <form action="/konsultasi/hasil" method="POST" class="mt-4">
      @csrf

      <div class="space-y-3">
        @foreach ($symptoms as $symptom)
          <input type="hidden" name="symptoms[]" value="{{ $symptom->code }}">
        @endforeach
      </div>

      <div class="grid grid-cols-2 gap-3 mt-8">
        <a href="/konsultasi/kembali" class="h-[52px] rounded-[14px] border flex justify-center items-center">
          Kembali
        </a>

        <button class="h-[52px] rounded-[14px] bg-[#7E57C2] text-white">
          Lihat Hasil
        </button>
      </div>
    </form>
  </div>
@endsection

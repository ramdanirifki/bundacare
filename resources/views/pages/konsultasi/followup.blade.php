@extends('layouts.app')

@section('content')
  <div class="min-h-screen pb-28 px-5 py-6">
    {{-- PROGRESS --}}
    <div class="mb-4">
      <div class="flex justify-between mb-2">
        <span class="text-sm text-[#7A7890]">
          Proses Diagnosis
        </span>

        <span class="text-sm font-medium text-[#7E57C2]">
          {{ $progress }}%
        </span>
      </div>

      <div class="h-3 bg-[#ECEAF5] rounded-full overflow-hidden">
        <div class="h-full bg-[#7E57C2] rounded-full transition-all duration-500" style="width: {{ $progress }}%">
        </div>
      </div>

      @if ($progress >= 80)
        <p class="text-xs text-green-600 mt-2">
          Diagnosis hampir selesai.
        </p>
      @else
        <p class="text-xs text-[#7A7890] mt-2">
          Sistem sedang menganalisis gejala Anda...
        </p>
      @endif
    </div>

    {{-- HEADER --}}
    <div class="flex items-center gap-3">
      <a href="/konsultasi/kembali"
        class="w-10 h-10 rounded-[14px] border border-[#E8E5F3] flex items-center justify-center shrink-0">
        <span class="material-symbols-rounded">
          arrow_back_ios_new
        </span>
      </a>

      <div>
        <h1 class="text-[28px] font-bold text-[#2D2A4A]">
          Konsultasi
        </h1>
        <p class="text-sm text-[#7A7890]">
          Jawab pertanyaan tambahan berdasarkan gejala yang dipilih.
        </p>
      </div>
    </div>

    <form method="POST" action="/konsultasi/answer" class="mt-8">
      @csrf

      {{-- FOLLOWUP --}}
      <div class="space-y-5">
        <div class="bg-white border border-[#E8E5F3] rounded-xl p-5">
          <p class="text-xs text-[#7A7890] mb-2">Pertanyaan Lanjutan</p>
          <h3 class="text-[17px] font-semibold text-[#2D2A4A]">Apakah Anda juga mengalami
            {{ strtolower($symptom->name) }}?</h3>
          <div class="grid grid-cols-2 gap-3 mt-1">
            <label class="cursor-pointer">
              <input type="radio" name="has" value="1" class="peer hidden yes-radio">
              <div
                class="h-[44px] rounded-[10px] border border-[#E8E5F3] flex justify-center items-center font-medium peer-checked:bg-[#7E57C2] peer-checked:text-white peer-checked:border-[#7E57C2]">
                Ya</div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="has" value="0" checked
                class="peer hidden no-radio">
              <div
                class="h-[44px] rounded-[10px] border border-[#E8E5F3] flex justify-center items-center font-medium peer-checked:bg-[#7E57C2] peer-checked:text-white peer-checked:border-[#7E57C2]">
                Tidak</div>
            </label>
          </div>
          <div class="cf-box hidden border border-[#ECEAF5] rounded-[10px] p-4 mt-2 bg-[#FAF9FF]">
            <p class="text-sm font-medium text-[#2D2A4A] mb-3">Seberapa yakin Anda mengalami gejala ini?</p>
            <select name="cf" class="w-full border border-[#E8E5F3] rounded-xl p-3">
              <option value="0.2">Sangat Ragu (20%)
              </option>
              <option value="0.4">Sedikit Yakin (40%)</option>
              <option value="0.6">Cukup Yakin (60%)</option>
              <option value="0.8">Yakin (80%)</option>
              <option value="1">Sangat Yakin (100%)</option>
            </select>
          </div>
        </div>
        <input type="hidden" name="symptom" value="{{ $symptom->code }}">
      </div>

      {{-- BUTTON --}}
      <button type="submit" class="mt-8 w-full h-[54px] rounded-xl bg-[#7E57C2] text-white font-medium">
        Lanjut
      </button>
    </form>
  </div>

  <script>
    document.querySelectorAll('.yes-radio').forEach(radio => {
      radio.addEventListener('change', function() {
        const card = this.closest('.bg-white');
        card.querySelector('.cf-box').classList.remove('hidden');
      });
    });

    document.querySelectorAll('.no-radio').forEach(radio => {
      radio.addEventListener('change', function() {
        const card = this.closest('.bg-white');
        card.querySelector('.cf-box').classList.add('hidden');
      });
    });
  </script>
@endsection

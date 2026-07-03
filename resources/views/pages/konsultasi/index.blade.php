@extends('layouts.app')

@section('content')
  <div class="min-h-screen pb-28 px-5 py-6">
    {{-- PROGRESS --}}
    <div class="mb-4">
      <div class="flex justify-between mb-2">
        <span class="text-sm text-[#7A7890]">
          Langkah 1 dari Proses Konsultasi
        </span>

        <span class="text-sm font-medium text-[#7E57C2]">
          Mulai
        </span>
      </div>

      <div class="h-3 bg-[#ECEAF5] rounded-full overflow-hidden">
        <div class="h-full bg-[#7E57C2] rounded-full" style="width: 10%">
        </div>
      </div>

      <p class="text-xs text-[#7A7890] mt-2">
        Pilih satu gejala utama untuk memulai analisis.
      </p>
    </div>

    {{-- HEADER --}}
    <div class="flex items-center gap-3">
      <a href="/home" id="backButton"
        class="w-10 h-10 rounded-[14px] border border-[#E8E5F3] flex items-center justify-center text-[#2D2A4A] shrink-0">
        <span class="material-symbols-rounded">
          arrow_back_ios_new
        </span>
      </a>

      <div>
        <h1 class="text-[28px] font-bold text-[#2D2A4A]">
          Konsultasi
        </h1>
        <p class="text-sm text-[#7A7890]">
          Pilih satu gejala utama yang paling Anda rasakan untuk memulai konsultasi.
        </p>
      </div>
    </div>

    {{-- FORM --}}
    <form action="/konsultasi/followup" method="POST" id="consultForm">
      @csrf

      <div class="space-y-3 mt-6">
        @foreach ($symptoms as $symptom)
          <label
            class="flex items-center gap-4 border border-[#ECEAF5] rounded-[14px] p-4 bg-white transition-all duration-200 hover:shadow-[0_4px_14px_rgba(45,42,74,0.06)] hover:border-[#DDD8F4] has-[:checked]:border-[#7E57C2] has-[:checked]:bg-[#FCFBFF] has-[:checked]:shadow-[0_6px_18px_rgba(126,87,194,0.12)]">
            <input type="checkbox" name="symptoms[]" value="{{ $symptom->code }}"
              class="symptom w-5 h-5 accent-violet-600">
            <div>
              <p class="font-medium text-[#2D2A4A]">
                {{ $symptom->name }}
              </p>

              <p class="text-xs text-[#9A98B1] mt-1">
                {{ $symptom->code }}
              </p>
            </div>
          </label>
        @endforeach
      </div>

      <button type="submit"
        class="mt-8 w-full h-[52px] rounded-[14px] bg-[#7E57C2] text-white font-medium hover:opacity-95 transition">
        Lanjut
      </button>
    </form>

  </div>

  <script>
    const symptoms = document.querySelectorAll('.symptom')

    symptoms.forEach(checkbox => {
      checkbox.addEventListener('change', () => {
        const total = document.querySelectorAll('.symptom:checked').length

        if (total > 1) {
          checkbox.checked = false

          Swal.fire({
            icon: 'warning',
            title: 'Maksimal 1 Gejala',
            text: 'Pilih satu gejala utama terlebih dahulu.',
            confirmButtonColor: '#7E57C2',
            confirmButtonText: 'Mengerti'
          })
        }
      })
    })

    document.getElementById('consultForm').addEventListener('submit', function(e) {
      const total = document.querySelectorAll('.symptom:checked').length

      if (total === 0) {
        e.preventDefault()

        Swal.fire({
          icon: 'info',
          title: 'Belum Ada Gejala',
          text: 'Pilih satu gejala utama terlebih dahulu.',
          confirmButtonColor: '#7E57C2'
        })
      }
    })

    document.getElementById('backButton').addEventListener('click', function(e) {
      const total = document.querySelectorAll('.symptom:checked').length

      if (total > 0) {
        e.preventDefault()

        Swal.fire({
          title: 'Keluar dari Konsultasi?',
          text: 'Gejala yang Anda pilih belum disimpan.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, keluar',
          cancelButtonText: 'Tetap di sini',
          confirmButtonColor: '#E53935',
          cancelButtonColor: '#7E57C2',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '/home'
          }
        })
      }
    })
  </script>
@endsection

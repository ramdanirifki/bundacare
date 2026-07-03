@extends('layouts.app')

@section('content')
  <div class="min-h-screen px-5 py-6 pb-28">

    {{-- BACK --}}
    <div class="flex items-center gap-3 mb-6">
      <div>
        <h1 class="text-[28px] font-bold text-[#2D2A4A]">
          Profil
        </h1>
        <p class="text-sm text-[#7A7890]">
          Kelola informasi akun anda
        </p>
      </div>
    </div>

    {{-- PROFILE --}}
    <div class="mt-6 bg-white rounded-[14px] border border-[#ECEAF5] p-5">
      <div class="flex items-center gap-4">

        {{-- PHOTO --}}
        <div class="w-16 h-16 rounded-full bg-[#EEE7FF] flex justify-center items-center">
          <span class="material-symbols-rounded text-[34px] text-[#7E57C2]">account_circle</span>
        </div>

        {{-- INFO --}}
        <div>
          <h2 class="font-semibold text-[18px] text-[#2D2A4A]">{{ $user->name }}</h2>
          <p class="text-sm text-[#7A7890]">{{ $user->email }}</p>
        </div>

      </div>
    </div>

    {{-- MENU --}}
    <div class="mt-5 space-y-3">

      @php
        $menus = [
            ['icon' => 'badge', 'title' => 'Informasi Pribadi'],
            ['icon' => 'settings', 'title' => 'Pengaturan'],
            ['icon' => 'notifications', 'title' => 'Notifikasi'],
            ['icon' => 'shield_lock', 'title' => 'Privasi & Keamanan'],
            ['icon' => 'info', 'title' => 'Tentang Kami'],
        ];
      @endphp

      @foreach ($menus as $menu)
        <a href="#"
          class="bg-white rounded-[14px] border border-[#ECEAF5] h-[62px] px-5 flex items-center justify-between">
          <div class="flex items-center gap-4">
            <span class="material-symbols-rounded text-[#7E57C2]">{{ $menu['icon'] }}</span>
            <span class="text-[#2D2A4A]">{{ $menu['title'] }}</span>
          </div>
          <span class="material-symbols-rounded text-[#B8B4C7]">chevron_right</span>
        </a>
      @endforeach

      {{-- LOGOUT --}}
      <form method="POST" action="/logout" id="logoutForm">
        @csrf
        <button type="button" id="logoutButton"
          class="mt-4 w-full h-[54px] rounded-[14px] border border-[#FFCECE] text-[#E5484D] font-medium">
          Keluar
        </button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('logoutButton').addEventListener('click', function() {
      Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi Keluar',
        text: 'Apakah Anda yakin ingin keluar dari akun ini?',
        showCancelButton: true,
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#E5484D',
        cancelButtonColor: '#7E57C2',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    });
  </script>
@endsection

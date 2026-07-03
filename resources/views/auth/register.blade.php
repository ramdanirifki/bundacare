<x-guest-layout>
  <div class="min-h-screen px-5 py-10 flex flex-col justify-center">

    {{-- HEADER --}}
    <div class="text-center mb-8">
      <h1 class="mt-5 text-[30px] font-bold text-[#2D2A4A]">BundaCare</h1>
      <p class="mt-2 text-sm text-[#7A7890]">Buat akun terlebih dahulu untuk mulai melakukan konsultasi.</p>
    </div>

    {{-- CARD REGISTER --}}
    <div class="bg-white border border-[#E8E5F3] rounded-[20px] p-6 shadow-sm">
      <h2 class="text-xl font-semibold text-[#2D2A4A]">Daftar Akun</h2>
      <p class="text-sm text-[#7A7890] mt-1">Lengkapi data berikut untuk membuat akun baru.</p>

      <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        {{-- NAMA --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Nama Lengkap</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
            autocomplete="name" placeholder="Masukkan nama lengkap"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- EMAIL --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required
            autocomplete="username" placeholder="Masukkan email"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PASSWORD --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Password</label>
          <input id="password" type="password" name="password" required autocomplete="new-password"
            placeholder="Masukkan password"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Konfirmasi Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required
            autocomplete="new-password" placeholder="Masukkan kembali password"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- BUTTON REGISTER --}}
        <button type="submit"
          class="w-full h-[54px] rounded-[14px] bg-[#7E57C2] text-white font-medium shadow hover:opacity-95 transition">
          Daftar
        </button>

        {{-- LOGIN --}}
        <div class="text-center">
          <p class="text-sm text-[#7A7890]">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-medium text-[#7E57C2] hover:underline">Masuk</a>
          </p>
        </div>

      </form>
    </div>

    {{-- FOOTER --}}
    <p class="mt-8 text-center text-xs text-[#9A98B1]">
      © {{ date('Y') }} BundaCare
      <br>
      Bantu kenali kondisi kehamilan sejak dini.
    </p>

  </div>
</x-guest-layout>

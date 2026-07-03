<x-guest-layout>
  <div class="min-h-screen px-5 py-10 flex flex-col justify-center">
    {{-- HEADER --}}
    <div class="text-center mb-8">
      <h1 class="mt-5 text-[30px] font-bold text-[#2D2A4A]">BundaCare</h1>
      <p class="mt-2 text-sm text-[#7A7890]">Sistem Deteksi Dini Kondisi Kehamilan Berdasarkan Gejala yang Dialami.</p>
    </div>

    {{-- CARD LOGIN --}}
    <div class="bg-white border border-[#E8E5F3] rounded-[20px] p-6 shadow-sm">
      <h2 class="text-xl font-semibold text-[#2D2A4A]">Masuk</h2>
      <p class="text-sm text-[#7A7890] mt-1">Silakan masuk untuk melanjutkan konsultasi.</p>

      <x-auth-session-status class="mt-4 text-sm text-green-600" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        {{-- EMAIL --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            autocomplete="username" placeholder="Masukkan email"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PASSWORD --}}
        <div>
          <label class="text-sm font-medium text-[#2D2A4A]">Password</label>
          <input id="password" type="password" name="password" required autocomplete="current-password"
            placeholder="Masukkan password"
            class="w-full mt-2 h-[52px] px-4 rounded-[14px] border border-[#E8E5F3] focus:border-[#7E57C2] focus:ring-[#7E57C2]">
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- REMEMBER --}}
        <label class="flex items-center gap-3">
          <input id="remember_me" type="checkbox" name="remember"
            class="rounded border-[#D9D5EA] text-[#7E57C2] focus:ring-[#7E57C2]">
          <span class="text-sm text-[#7A7890]">Ingat saya</span>
        </label>

        {{-- LUPA PASSWORD --}}
        @if (Route::has('password.request'))
          <div class="text-right">
            <a href="{{ route('password.request') }}" class="text-sm text-[#7E57C2] hover:underline">Lupa password?</a>
          </div>
        @endif

        {{-- BUTTON LOGIN --}}
        <button type="submit"
          class="w-full h-[54px] rounded-[14px] bg-[#7E57C2] text-white font-medium shadow hover:opacity-95 transition">
          Masuk
        </button>

        {{-- BUTTON REGISTER --}}
        <a href="{{ route('register') }}"
          class="flex justify-center items-center w-full h-[54px] rounded-[14px] border border-[#E8E5F3] text-[#2D2A4A] font-medium hover:bg-[#FAF9FF] transition">
          Daftar Akun Baru
        </a>
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

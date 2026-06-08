@extends('layouts.splash')

@section('content')
  <div class="container-mobile h-screen bg-white flex flex-col justify-center items-center px-8 relative">
    <img src="{{ asset('assets/images/hero.png') }}" class="w-40 mb-5">

    <h1 class="text-3xl font-semibold text-violet-600">
      BundaCare
    </h1>

    <p class="text-gray-500 mt-2 text-center">
      Sistem Pakar untuk membantu<br> 
      mendeteksi bahaya kehamilan<br> 
      berdasarkan gejala yang anda alami
    </p>

    <div class="mt-14 w-2/3 flex flex-col items-center">
      <div id="loading" class="w-28 h-28">
      </div>

      <p class="text-gray-500 mt-2">
        Memuat...
      </p>
    </div>
  </div>

  <script>
    setTimeout(() => {
      window.location = '/login'
    }, 3000)
  </script>
@endsection

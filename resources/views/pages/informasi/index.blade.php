@extends('layouts.app')

@section('content')
  <div class="min-h-screen px-6 py-8 pb-28">

    {{-- HEADER --}}
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Artikel Edukasi</h1>
      <p class="text-gray-500 mt-1">
        Halaman ini berisi edukasi seputar kehamilan.
      </p>
    </div>

    {{-- DAFTAR ARTIKEL / EDUKASI --}}
    <div class="mt-8">
      <div class="grid grid-cols-1 gap-6">
        {{-- Artikel 1 --}}
        <div class="bg-white p-5 rounded-[14px] border border-[#ECEAF5]">
          <h3 class="font-semibold text-gray-800">Tanda Awal Kehamilan</h3>
          <p class="text-sm text-gray-600 mt-2">
            Mengenal tanda-tanda awal kehamilan yang sering tidak disadari oleh wanita.
          </p>
          <button class="mt-3 text-violet-600 text-sm font-medium">Baca Selengkapnya →</button>
        </div>

        {{-- Artikel 2 --}}
        <div class="bg-white p-5 rounded-[14px] border border-[#ECEAF5]">
          <h3 class="font-semibold text-gray-800">Pentingnya Pemeriksaan Dini</h3>
          <p class="text-sm text-gray-600 mt-2">
            Pemeriksaan dini membantu memastikan kondisi kesehatan ibu dan janin.
          </p>
          <button class="mt-3 text-violet-600 text-sm font-medium">Baca Selengkapnya →</button>
        </div>

        {{-- Artikel 3 --}}
        <div class="bg-white p-5 rounded-[14px] border border-[#ECEAF5]">
          <h3 class="font-semibold text-gray-800">Perubahan Hormon</h3>
          <p class="text-sm text-gray-600 mt-2">
            Bagaimana hormon memengaruhi tubuh pada awal kehamilan.
          </p>
          <button class="mt-3 text-violet-600 text-sm font-medium">Baca Selengkapnya →</button>
        </div>

        {{-- Artikel 4 --}}
        <div class="bg-white p-5 rounded-[14px] border border-[#ECEAF5]">
          <h3 class="font-semibold text-gray-800">Gaya Hidup Sehat</h3>
          <p class="text-sm text-gray-600 mt-2">
            Tips menjaga kesehatan bagi wanita yang merencanakan kehamilan.
          </p>
          <button class="mt-3 text-violet-600 text-sm font-medium">Baca Selengkapnya →</button>
        </div>

      </div>
    </div>

  </div>
@endsection

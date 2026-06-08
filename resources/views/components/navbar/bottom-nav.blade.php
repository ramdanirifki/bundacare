<nav class="fixed bottom-0 left-1/2 -translate-x-1/2 max-w-[430px] w-full bg-white border-t py-4 z-50">
  <div class="grid grid-cols-5">
    @php
      $menus = [
          ['/home', 'home', 'Home'],
          ['/konsultasi', 'clinical_notes', 'Konsultasi'],
          ['/riwayat', 'history', 'Riwayat'],
          ['/informasi', 'menu_book', 'Info'],
          ['/profil', 'person', 'Profil'],
      ];

    @endphp
    @foreach ($menus as $m)
      <a href="{{ $m[0] }}" class="flex flex-col items-center gap-1 text-gray-500">
        <span class="material-symbols-outlined">
          {{ $m[1] }}
        </span>

        <span class="text-[10px]">
          {{ $m[2] }}
        </span>
      </a>
    @endforeach
  </div>
</nav>

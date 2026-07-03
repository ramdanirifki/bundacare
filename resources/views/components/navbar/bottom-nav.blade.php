<nav class="fixed bottom-0 left-1/2 -translate-x-1/2 max-w-[430px] w-full bg-white border-t py-4 z-50">
  <div class="grid grid-cols-5">
    @php
      $menus = [
          [
              'url' => '/home',
              'icon' => 'home',
              'label' => 'Home',
              'active' => request()->routeIs('home'),
          ],
          [
              'url' => '/konsultasi',
              'icon' => 'clinical_notes',
              'label' => 'Konsultasi',
              'active' => request()->routeIs('konsultasi.*'),
          ],
          [
              'url' => '/riwayat',
              'icon' => 'history',
              'label' => 'Riwayat',
              'active' => request()->routeIs('riwayat.*'),
          ],
          [
              'url' => '/informasi',
              'icon' => 'menu_book',
              'label' => 'Artikel',
              'active' => request()->routeIs('informasi'),
          ],
          [
              'url' => '/profil',
              'icon' => 'person',
              'label' => 'Profil',
              'active' => request()->routeIs('profil'),
          ],
      ];
    @endphp

    @foreach ($menus as $menu)
      <a href="{{ $menu['url'] }}" class="nav-item flex flex-col items-center gap-1 transition-colors {{ $menu['active'] ? 'text-[#7E57C2]' : 'text-gray-500' }}">
        <span class="material-symbols-outlined">
          {{ $menu['icon'] }}
        </span>

        <span class="text-[10px]">
          {{ $menu['label'] }}
        </span>
      </a>
    @endforeach
  </div>
</nav>

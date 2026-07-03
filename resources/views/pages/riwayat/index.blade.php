@extends('layouts.app')

@section('content')
  <div class="min-h-[calc(100vh-96px)] pb-28 px-5 py-6">
    {{-- HEADER --}}
    <div class="mb-6">
      <h1 class="text-[28px] font-bold text-[#2D2A4A]">Riwayat Konsultasi</h1>
      <p class="text-sm text-[#7A7890]">Daftar hasil konsultasi yang pernah dilakukan</p>
    </div>
    <div class="space-y-4">
      @forelse ($consultations as $item)
        @php
          $status = $item->diagnosis->status ?? '-';
          $badgeClass = match ($status) {
              'normal' => 'bg-yellow-100 text-yellow-700',
              'perlu_kontrol' => 'bg-red-100 text-red-700',
              default => 'bg-gray-100 text-gray-700',
          };
          $statusLabel = match ($status) {
              'normal' => 'Normal',
              'perlu_kontrol' => 'Perlu Kontrol',
              'serius' => 'Serius',
              'darurat' => 'Darurat',
              default => ucfirst($status),
          };
          $score = round(($item->score ?? 0));
        @endphp
        <a href="/riwayat/{{ $item->id }}"
          class="block bg-white border border-[#E8E5F3] rounded-[18px] p-5">
          <div class="flex justify-between items-start">
            <div>
              <h2 class="font-semibold text-[#2D2A4A] text-lg">{{ $item->diagnosis->name ?? '-' }}</h2>
              <p class="text-xs text-[#7A7890] mt-1">{{ $item->created_at->format('d M Y • H:i') }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs {{ $badgeClass }}">{{ $statusLabel }}</span>
          </div>
          {{-- SCORE --}}
          <div class="mt-4">
            <div class="flex justify-between mb-2">
              <span class="text-sm text-[#7A7890]">Tingkat kecocokan</span>
              <span class="font-semibold text-[#7E57C2]">{{ $score }}%</span>
            </div>
            <div class="h-2 rounded-full bg-[#F2F0FA] overflow-hidden">
              <div class="h-full rounded-full bg-[#7E57C2]" style="width: {{ $score }}%"></div>
            </div>
          </div>
          <p class="text-sm text-[#7A7890] mt-4 line-clamp-2">{{ $item->diagnosis->solution }}</p>
        </a>
      @empty
        <div class="text-center mt-24">
          <span class="material-symbols-rounded text-[60px] text-[#D3CEE6]">history</span>
          <p class="mt-3 text-[#7A7890]">Belum ada riwayat konsultasi</p>
        </div>
      @endforelse
    </div>
  </div>
  @if (session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#7E57C2'
      })
    </script>
  @endif
@endsection

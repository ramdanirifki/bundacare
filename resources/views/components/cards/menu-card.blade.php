<a href="{{ $href }}" class="block bg-white border border-[#E8E5F3] rounded-2xl p-4 mb-3 transition hover:shadow-sm">
  <div class="flex justify-between items-center">
    <div class="flex items-center gap-4">
      <div class="w-[48px] h-[48px] bg-[#F5F1FF] rounded-[12px] flex items-center justify-center">
        <span class="material-symbols-outlined text-[#7E57C2]">
          {{ $icon }}
        </span>
      </div>

      <div>
        <h3 class="font-semibold text-[#2D2A4A]">
          {{ $title }}
        </h3>

        <p class="text-[13px] text-[#7A7890] mt-1">
          {{ $subtitle }}
        </p>
      </div>
    </div>

    <span class="material-symbols-outlined text-[#C5BDD8]">
      arrow_forward_ios
    </span>
  </div>
</a>

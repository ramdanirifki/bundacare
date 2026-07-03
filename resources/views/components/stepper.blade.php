@props([
  'step' => 1,
])

<div class="flex items-center gap-2 mb-8">
  @for ($i = 1; $i <= 4; $i++)
    <div class="flex-1 h-[6px] rounded-full {{ $i <= $step ? 'bg-[#7E57C2]' : 'bg-[#EAE6F8]' }}">
    </div>
  @endfor

</div>

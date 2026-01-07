<a href="{{ $href }}" wire:navigate @class([
    'flex cursor-pointer items-center justify-center overflow-hidden rounded-lg px-6 bg-primary hover:bg-blue-700 transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em]',
    $class,
])>
    <span class="material-symbols-outlined">{{ $logo }}</span>
    <span class="truncate">
        {{ $title }}
    </span>
</a>

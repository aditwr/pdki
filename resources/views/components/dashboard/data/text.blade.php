@props(['label', 'value', 'containerClass' => '', 'valueClass' => ''])

<div class="w-full mb-3 {{ $containerClass ?? '' }}">
    <label class="w-full form-control">
        <div class="label">
            <span class="text-base font-semibold label-text">{{ $label }}</span>
        </div>
        <span
            class="block w-full p-3 border border-neutral/20 rounded-btn {{ $valueClass ?? '' }}">{{ $value }}</span>
    </label>
</div>

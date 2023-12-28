@props(['name', 'label', 'placeholder', 'containerClass' => '', 'value' => '', 'valueClass' => ''])

<label class="w-full mb-3 form-control {{ $containerClass ?? '' }}">
    <div class="label">
        <span class="text-base font-semibold label-text">{{ $label }}</span>
    </div>
    <input name="{{ $name }}" id="{{ $name }}" type="text" placeholder="{{ $placeholder }}"
        value="{{ $value }}" class="w-full input input-bordered {{ $valueClass ?? '' }}" {{ $attributes }} />
    @error($name)
        <div class="label">
            <span class="font-bold label-text-alt text-error">{{ $message }}</span>
        </div>
    @enderror
</label>

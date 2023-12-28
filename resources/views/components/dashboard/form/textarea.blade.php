@props(['name', 'label', 'value', 'containerClass'])

<label class="w-full mb-3 form-control {{ $containerClass }}">
    <div class="label">
        <span class="text-base font-semibold label-text">{{ $label }}</span>
    </div>
    @error($name)
        <div class="label">
            <span class="font-bold label-text-alt text-error">{{ $message }}</span>
        </div>
    @enderror
    <textarea name="{{ $name }}" id="{{ $name }}" class="textarea textarea-bordered" {{ $attributes }}>{{ $value }}</textarea>
</label>

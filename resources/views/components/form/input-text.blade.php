@props(['name'])

<input type="text" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
<div class="label">
    @error($name)
        <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
    @enderror
</div>

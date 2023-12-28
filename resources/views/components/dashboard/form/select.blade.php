@props(['name', 'label', 'value', 'containerClass', 'items'])

<label class="w-full mb-3 form-control {{ $containerClass }}">
    <div class="label">
        <span class="text-base font-semibold label-text">{{ $label }}</span>
    </div>
    <select name="{{ $name }}" id="{{ $name }}" class="w-full max-w-xs select select-bordered">
        <option disabled>Pilih</option>
        @isset($items)
            @foreach ($items as $key => $item)
                <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        @endisset
    </select>
    @error($name)
        <div class="label">
            <span class="font-bold label-text-alt text-error">{{ $message }}</span>
        </div>
    @enderror
</label>

@props(['name'])

<div x-data="{
    password_visibility: false,
    toggle_password_visibility: function() {
        this.password_visibility = !this.password_visibility
        if (this.password_visibility) {
            $refs.eyeIcon.innerHTML = `<svg class='w-5 h-5 text-neutral/80 dark:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg'
    fill='none' viewBox='0 0 20 18'>
    <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
        d='M1.933 10.909A4.357 4.357 0 0 1 1 9c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 19 9c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M2 17 18 1m-5 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z' />
    </svg>`
            document.getElementById('{{ $name }}').type = 'text';
        } else {
            $refs.eyeIcon.innerHTML = `<svg class='w-5 h-5 text-neutral/80 dark:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg'
                fill='none' viewBox='0 0 20 14'>
                <g stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                    <path d='M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z' />
                    <path d='M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z' />
                </g>
            </svg>`;
            document.getElementById('{{ $name }}').type = 'password';
        }
    }
}" class="relative rounded-lg">
    <input type="password" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
    <div class="absolute top-0 right-0 flex items-center h-full px-3">
        <button x-ref="eyeIcon" type="button" id="eye-icon" @click="toggle_password_visibility">
            <svg class="w-5 h-5 text-neutral/80 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 14">
                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                </g>
            </svg>
        </button>
    </div>
</div>
<div class="label">
    @error($name)
        <span class="label-text-alt text-error">{{ $message }}</span>
    @enderror
</div>

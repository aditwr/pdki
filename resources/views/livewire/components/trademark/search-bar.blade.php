<div x-data="{
    doSearch() {
        $refs.searchButtonIcon.innerHTML = `<span class='loading loading-spinner loading-sm'></span>`;
        $refs.searchButtonText.innerText = 'Mencari...';
        $wire.doSearch();
    }
}"
    class="flex flex-col sm:flex-row gap-y-3 items-center justify-center gap-x-4 {{ $containerClass }}">
    <div class="flex-1 w-full transition-all duration-300">
        <div class="form-control">
            <input x-ref="input" id="{{ $inputId }}" name="{{ $inputName }}" wire:model='search'
                x-on:keydown.enter="doSearch()" type="text" placeholder="Search"
                class="input input-bordered rounded-badge">
        </div>
    </div>
    <button x-ref="keyword" x-on:click="doSearch()"
        class="transition-all duration-300 btn btn-primary text-primary-content rounded-badge">
        <div class="flex items-center gap-x-2">
            <div x-ref="searchButtonIcon" id="search-button-icon">
                <svg class="w-5 h-5 text-primary-content" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <span x-ref="searchButtonText" id="search-button-text" x-text="$wire.searchButtonText"
                class="text-primary-content"></span>
        </div>
    </button>
</div>
@push('scripts_body')
    <script>
        // 
    </script>
@endpush

<div class="@if (!$state) h-screen flex justify-center items-center w-full @else @endif"
    id="result-page">
    <div class="w-full pb-12" wire:ignore>
        <div class="flex flex-col items-center">
            <h1 class="mb-8 text-3xl font-bold capitalize text-neutral-800">
                Pangkalan Data Kekayaan Intelektual
            </h1>
            <h5 class="mb-0 text-lg font-medium text-neutral/80">Pencarian Merek</h5>
        </div>
        <div class="flex justify-center py-4">
            {{-- Search Bar --}}
            <livewire:components.trademark.search-bar input-id="search-trademark-2" input-name="search-trademark-2"
                container-class="basis-6/12" search-button-text="Cari" />
            {{-- End of Search Bar --}}
        </div>
        <div class="flex justify-center">
            <div class="basis-8/12">
                <livewire:components.trademark.search-result container-class="w-full" />
            </div>
        </div>
    </div>
</div>

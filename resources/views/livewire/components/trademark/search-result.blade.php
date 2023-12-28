<div class="mt-4">
    @if (!$lihatDetail)
        <div class="">
            @if ($searchStatus)
                @if (count($searchResult) > 0)
                    <div class="flex justify-end w-full mb-3 gap-x-4">
                        <span class="text-sm">Max Score : <span
                                class="text-base font-semibold">{{ $maxScore }}</span></span>
                        <span class="text-sm">Hasil Pencarian : <span
                                class="text-base font-semibold">{{ $totalHits }}</span>
                            Item</span>
                    </div>
                    <div class="p-4 bg-base-200 rounded-badge {{ $containerClass }} flex flex-col gap-y-4 pt-4">
                        @foreach ($searchResult as $trademark)
                            {{-- Trademark Item --}}
                            <div class="p-3 bg-base-100 rounded-badge">
                                <div class="flex flex-col w-full sm:flex-row">
                                    {{-- Trademark Logo --}}
                                    <div
                                        class="flex items-center justify-center flex-none w-full overflow-hidden h-44 bg-base-100 sm:w-40 sm:h-32 rounded-badge">
                                        <img src="{{ $trademark['_source']['image'][0]['image_path'] ?? asset('assets/images/img_not_found.png') }}"
                                            alt="brand" class="object-cover w-full h-auto">
                                    </div>
                                    {{-- Description --}}
                                    <div class="flex-grow py-2 pl-4 pr-2">
                                        <div
                                            class="flex flex-col items-baseline justify-between w-full mb-3 gap-y-2 sm:flex-row gap-x-3">
                                            <h5 class="text-2xl font-semibold text-neutral/90 line-clamp-1 tooltip"
                                                data-tip="hello">
                                                {{ $trademark['_source']['nama_merek'] ?? '-' }}
                                            </h5>
                                            <div
                                                class="flex items-center text-sm text-neutral-content gap-x-1 badge badge-neutral">
                                                <svg class="w-4 h-4 text-green-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 18 20">
                                                    <path
                                                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                                                </svg>
                                                <span
                                                    class="font-semibold">{{ $trademark['_source']['status_group']['status_group'] ?? '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="flex mb-3 font-semibold text-neutral/70 gap-x-1">
                                            <svg class="w-6 h-6 text-neutral/80" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill="currentColor"
                                                    d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z" />
                                                <path fill="#fff"
                                                    d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z" />
                                            </svg>
                                            <span
                                                class="capitalize line-clamp-1">{{ $trademark['_source']['owner'][0]['tm_owner_name'] ?? '-' }}</span>
                                        </div>
                                        <div class="flex flex-col items-baseline justify-between gap-y-4 sm:flex-row">
                                            <div class="flex gap-x-4">
                                                <span
                                                    class="block text-sm font-semibold text-neutral/70 badge badge-ghost">Kelas
                                                    {{ $trademark['_source']['t_class'][0]['class_no'] ?? '-' }}</span>
                                                <span
                                                    class="block text-sm font-medium text-neutral/50 badge">{{ $trademark['_source']['nomor_permohonan'] ?? '-' }}</span>
                                                <span class="block text-sm font-medium text-neutral/50 badge">Score :
                                                    {{ $trademark['_score'] ?? '-' }}</span>
                                            </div>
                                            <button wire:click="detail({{ $loop->index }})"
                                                class="flex items-center px-4 btn btn-primary btn-sm gap-x-1 rounded-badge">
                                                <a href="#result-page" class="">Detail</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Pagination --}}
                    <div class="flex justify-center w-full mt-4 mb-2">
                        <div class="join">
                            @if ($currentPage > 1)
                                <button wire:click="$set('currentPage', {{ $currentPage - 1 }})"
                                    class="join-item btn">«</button>
                            @endif
                            <button wire:click="pagination({{ $currentPage }})"
                                class="join-item btn btn-neutral">{{ $currentPage }}</button>
                            @if ($currentPage < $totalPage)
                                <button wire:click="pagination({{ $currentPage + 1 }})"
                                    class="join-item btn">{{ $currentPage + 1 }}</button>
                                <button wire:click="pagination({{ $currentPage + 2 }})"
                                    class="join-item btn">{{ $currentPage + 2 }}</button>
                                <button wire:click="pagination({{ $currentPage + 3 }})"
                                    class="join-item btn">{{ $currentPage + 3 }}</button>
                                <button wire:click="pagination({{ $currentPage + 4 }})"
                                    class="join-item btn">{{ $currentPage + 4 }}</button>
                                <button wire:click="pagination({{ $currentPage + 5 }})"
                                    class="join-item btn">{{ $currentPage + 5 }}</button>
                            @endif
                            <button class="join-item btn btn-disabled">...</button>
                            <button wire:click="pagination({{ $totalPage }})"
                                class="join-item btn">{{ $totalPage }}</button>
                            @if ($currentPage < $totalPage)
                                <button wire:click="$set('currentPage', {{ $currentPage + 1 }})"
                                    class="join-item btn">»</button>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center w-full h-full py-8">
                        <svg class="w-16 h-16 text-neutral/50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 18.75A8.75 8.75 0 1 1 18.75 10 8.76 8.76 0 0 1 10 18.75Z" />
                            <path
                                d="M10 4.375a1.25 1.25 0 0 0-1.25 1.25v5a1.25 1.25 0 0 0 2.5 0v-5A1.25 1.25 0 0 0 10 4.375Z" />
                            <path
                                d="M10 14.375a1.25 1.25 0 0 0-1.25 1.25v.625a1.25 1.25 0 0 0 2.5 0v-.625A1.25 1.25 0 0 0 10 14.375Z" />
                        </svg>
                        <span class="mt-4 text-lg font-semibold text-neutral/50">Tidak ada hasil</span>
                    </div>
                @endif
            @else
                <div
                    class="flex flex-col items-center justify-center w-full h-full py-8 @if (!$searchStatus) hidden @endif">
                    <svg class="w-16 h-16 text-neutral/50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 18.75A8.75 8.75 0 1 1 18.75 10 8.76 8.76 0 0 1 10 18.75Z" />
                        <path
                            d="M10 4.375a1.25 1.25 0 0 0-1.25 1.25v5a1.25 1.25 0 0 0 2.5 0v-5A1.25 1.25 0 0 0 10 4.375Z" />
                        <path
                            d="M10 14.375a1.25 1.25 0 0 0-1.25 1.25v.625a1.25 1.25 0 0 0 2.5 0v-.625A1.25 1.25 0 0 0 10 14.375Z" />
                    </svg>
                    <span class="mt-4 text-lg font-semibold text-neutral/50">Terjadi Kesalahan saat Request Data</span>
                </div>
            @endif
        </div>
    @else
        {{-- Detail --}}
        <div
            class="p-4 bg-base-100 border w-full border-base-300 rounded-badge {{ $containerClass }} flex flex-col gap-y-4 pt-4">
            <div class="px-2 py-4">
                {{-- No Pendaftaran dan Tgl Pendaftaran --}}
                <div class="flex">
                    <div class="flex flex-col w-1/2">
                        <span class="text-sm font-semibold text-neutral/70">No Pendaftaran</span>
                        <span
                            class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['nomor_pendaftaran'] ?? '-' }}</span>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <span class="text-sm font-semibold text-neutral/70">Tanggal Pendaftaran</span>
                        <span
                            class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['tanggal_pendaftaran'] ?? '-' }}</span>
                    </div>
                    {{-- <div class="flex flex-col w-1/2">
                        <span class="text-sm font-semibold text-neutral/70">Publikasi</span>
                        <span class="text-lg font-semibold text-neutral/90">Publikasi A</span>
                    </div> --}}
                </div>

                {{-- Gambar --}}
                <div class="flex flex-col mt-4">
                    <span class="block mb-2 text-sm font-semibold text-neutral/70">Gambar</span>
                    <div
                        class="flex flex-col items-center justify-center w-full h-64 overflow-hidden border bg-base-100 rounded-badge">
                        <img src="{{ $trademarkDetail['_source']['image'][0]['image_path'] ?? asset('assets/images/img_not_found.png') }}"
                            alt="brand" class="object-contain w-auto h-full">
                    </div>
                </div>
                {{-- Nama Merek --}}
                <div class="my-2">
                    <span
                        class="text-2xl font-semibold text-neutral/90">{{ $trademarkDetail['_source']['nama_merek'] ?? '-' }}</span>
                </div>
                {{-- Detail --}}
                <span class="text-sm font-bold text-neutral/70">Detail</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-box">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Nomor Pengumuman</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['nomor_pengumuman'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Tanggal Pengumuman</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['tanggal_pengumuman'] ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Nomor Permohonan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['nomor_permohonan'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Tanggal Penerimaan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['tanggal_permohonan'] ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Tgl Dimulai Perlindungan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['tanggal_dimulai_perlindungan'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Tgl Berakhir Perlindungan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['tanggal_berakhir_perlindungan'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Translasi --}}
                <div class="px-4 py-4 mt-8 border bg-base-100 rounded-box">
                    <span class="text-sm font-semibold text-neutral/70">Translasi</span>
                    <div class="flex flex-col mt-2">
                        <span
                            class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['translasi'] ?? '-' }}</span>
                    </div>
                </div>

                {{-- Kelas --}}
                <span class="block mt-8 mb-2 text-sm font-bold text-neutral/70">Kelas Nice</span>
                <div class="px-4 py-4 border bg-base-100 rounded-box">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Jenis Barang / Jasa</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['t_class'][0]['class_desc'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Kode kelas</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['t_class'][0]['class_no'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Pemilik --}}
                <span class="block mt-8 text-sm font-bold text-neutral/70">Pemilik</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-box">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Nama</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['owner'][0]['tm_owner_name'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Alamat</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['owner'][0]['tm_owner_address'] ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Kewarganegaraan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['owner'][0]['country_name'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Konsultan --}}
                <span class="block mt-8 text-sm font-bold text-neutral/70">Konsultan</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-box">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Nama</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['consultant'][0]['reprs_name'] ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Alamat</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['consultant'][0]['reprs_address'] ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/70">Kewarganegaraan</span>
                            <span
                                class="text-lg font-semibold text-neutral/90">{{ $trademarkDetail['_source']['consultant'][0]['country_name'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Exit Detail --}}
                <button class="mt-6 btn btn-error text-error-content" wire:click="exitdetail()">
                    Kembali
                </button>
            </div>
        </div>
    @endif

    @push('scripts_body')
    @endpush

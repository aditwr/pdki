<div x-data="{
    deleteId: null,
    judulPengumuman: '',
    setDelete(id) {
        this.deleteId = id;
        this.judulPengumuman = document.getElementById('judul_' + id).innerText;
        this.$refs.judul_in_modal.innerText = this.judulPengumuman;
    }
}">
    {{-- Pengumuman Aktif --}}
    <div class="flex-grow max-w-5xl p-6 mt-8 border rounded-box bg-base-200">
        @if (count($pengumuman_aktif) > 0)
            @foreach ($pengumuman_aktif as $pengumuman)
                <div tabindex="0" id="pengumuman-{{ $pengumuman->id }}"
                    class="w-full mb-3 border collapse rounded-btn collapse-arrow border-base-300 bg-base-100">
                    <div class="font-medium collapse-title">
                        <div class="flex items-center justify-between gap-x-8">
                            <div id="judul_{{ $pengumuman->id }}" class="text-base font-semibold line-clamp-2">
                                {{ $pengumuman->judul_pengumuman }}
                            </div>

                            <div class="flex gap-x-4">
                                {{-- Action --}}
                                @can('akses-admin')
                                    <div class="flex gap-x-2">
                                        <a href="{{ route('pengumuman.edit', $pengumuman->id) }}"
                                            class="btn btn-sm btn-warning"><svg
                                                class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                <path
                                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                <path
                                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                            </svg></a>
                                        <!-- You can open the modal using ID.showModal() method -->
                                        <div class="">
                                            <button class="btn btn-sm btn-error" @click="setDelete({{ $pengumuman->id }})"
                                                onclick="my_modal_3.showModal()"><svg
                                                    class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 18 20">
                                                    <path
                                                        d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                                </svg></button>
                                        </div>
                                    </div>
                                @endcan
                                <div class="flex items-center gap-x-2">
                                    <svg class="w-4 h-4 text-neutral-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span
                                        class="text-xs">{{ formatDate($pengumuman->tanggal_mulai_pengumuman, 'd M Y') }}
                                    </span>
                                    -
                                    <span
                                        class="text-xs">{{ formatDate($pengumuman->tanggal_akhir_pengumuman, 'd M Y') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-full collapse-content">
                        <article class="prose max-w-none bg-base-100 rounded-btn prose-p:leading-tight">
                            {!! $pengumuman->isi_pengumuman !!}
                        </article>
                    </div>

                </div>
            @endforeach
        @else
            <div class="flex flex-col items-center justify-center w-full h-64">
                <div class="flex flex-col items-center justify-center gap-y-2">
                    <img src="{{ asset('assets/images/empty-box.png') }}" alt="" class="w-auto h-32">
                    <span class="text-xl font-medium text-neutral-600">Tidak ada pengumuman</span>
                </div>
            </div>
        @endif
    </div>
    <div class="flex justify-center w-full mt-8">
        {{ $pengumuman_aktif->links() }}
    </div>

    <div class="mt-4">
        <div class="collapse collapse-arrow bg-base-200">
            <input type="checkbox" />
            <div class="font-semibold text-md collapse-title">
                Lihat pengumuman yang telah berlalu
            </div>
            <div class="collapse-content">
                {{-- Pengumuman Berlalu --}}
                <div class="">
                    <div class="flex justify-between w-full mt-4 mb-2">
                        <h1 class="text-lg font-semibold">
                            Pengumuman Berlalu
                        </h1>
                    </div>

                    <div class="flex-grow max-w-5xl">
                        @if (count($pengumuman_berlalu) > 0)
                            @foreach ($pengumuman_berlalu as $pengumuman)
                                <div tabindex="0" id="pengumuman-{{ $pengumuman->id }}"
                                    class="w-full mb-3 border collapse rounded-btn collapse-arrow border-base-300 bg-base-100">
                                    <div class="font-medium collapse-title">
                                        <div class="flex items-center justify-between gap-x-8">
                                            <div id="judul_{{ $pengumuman->id }}"
                                                class="text-base font-semibold line-clamp-2">
                                                {{ $pengumuman->judul_pengumuman }}
                                            </div>
                                            <div class="flex gap-x-4">
                                                {{-- Action --}}
                                                @can('akses-admin')
                                                    <div class="flex gap-x-2">
                                                        <a href="{{ route('pengumuman.edit', $pengumuman->id) }}"
                                                            class="btn btn-sm btn-warning"><svg
                                                                class="w-4 h-4 text-gray-800 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="currentColor" viewBox="0 0 20 18">
                                                                <path
                                                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                                <path
                                                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                            </svg></a>
                                                        <!-- You can open the modal using ID.showModal() method -->
                                                        <div class="">
                                                            <button class="btn btn-sm btn-error"
                                                                @click="setDelete({{ $pengumuman->id }})"
                                                                onclick="my_modal_3.showModal()"><svg
                                                                    class="w-4 h-4 text-gray-800 dark:text-white"
                                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="currentColor" viewBox="0 0 18 20">
                                                                    <path
                                                                        d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                                                </svg></button>
                                                        </div>
                                                    </div>
                                                @endcan
                                                <div class="flex items-center gap-x-2">
                                                    <svg class="w-4 h-4 text-neutral-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <span
                                                        class="text-xs">{{ formatDate($pengumuman->tanggal_mulai_pengumuman, 'd M Y') }}
                                                    </span>
                                                    -
                                                    <span
                                                        class="text-xs">{{ formatDate($pengumuman->tanggal_akhir_pengumuman, 'd M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full collapse-content">
                                        <article class="prose max-w-none bg-base-100 rounded-btn prose-p:leading-tight">
                                            {!! $pengumuman->isi_pengumuman !!}
                                        </article>
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="flex flex-col items-center justify-center w-full h-64">
                                <div class="flex flex-col items-center justify-center gap-y-2">
                                    <img src="{{ asset('assets/images/empty-box.png') }}" alt=""
                                        class="w-auto h-32">
                                    <span class="text-xl font-medium text-neutral-600">Belum ada pengumuman yang
                                        berlalu</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-center w-full mt-8">
                        {{ $pengumuman_berlalu->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <dialog id="my_modal_3" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Konfirmasi</h3>
            <p class="py-4">Apakah anda yakin ingin menghapus pengumuman " <span x-ref="judul_in_modal"
                    class="font-semibold"></span> "</p>
            <div class="modal-action">
                <button class="btn btn-ghost">Batal</button>
                <div class="">
                    <form action="{{ route('pengumuman.delete') }}" method="POST" class="">
                        @csrf
                        <input x-model="deleteId" type="hidden" name="id">
                        <button type="submit" class="text-white btn btn-error">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </dialog>
</div>

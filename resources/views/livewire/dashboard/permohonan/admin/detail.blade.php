<div class="">
    <div class="flex justify-between w-full mt-8">
        <h1 class="text-3xl font-bold">
            Detail Pendaftaran Merek
        </h1>
        {{-- <a href="{{ route('permohonan.pendaftaran-merek') }}" class="btn btn-primary">Ajukan Pendaftaran Merek</a> --}}
    </div>
    <div class="flex gap-x-8">
        <div class="flex-grow max-w-4xl p-6 mt-8 border rounded-btn">
            {{-- Detail --}}
            <div class="px-2 py-4">
                {{-- No Pendaftaran dan Tgl Pendaftaran --}}
                <div class="flex">
                    <div class="flex flex-col w-1/2">
                        <span class="text-xs font-semibold text-neutral/80">No Permohonan</span>
                        <span
                            class="mt-2 text-base font-semibold badge badge-ghost text-neutral">{{ $pendaftaran_merek->no_permohonan ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between w-1/2">
                        <div class="flex flex-col ">
                            <span class="text-xs font-semibold text-neutral/80">Tanggal Permohonan</span>
                            <span
                                class="mt-1 text-base font-semibold text-neutral">{{ formatDate($pendaftaran_merek->created_at) ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-semibold text-neutral/80">Status Permohonan</span>
                            @if ($pendaftaran_merek->status == 0)
                                <span
                                    class="mt-1 text-sm font-semibold badge badge-neutral text-neutral-content">Menunggu
                                    Verifikasi</span>
                            @elseif($pendaftaran_merek->status == 1)
                                <span class="mt-1 text-sm font-semibold badge badge-warning text-neutral">Revisi</span>
                            @elseif($pendaftaran_merek->status == 2)
                                <span
                                    class="mt-1 text-sm font-semibold badge badge-neutral text-neutral-content">Selesai
                                    Revisi</span>
                            @elseif($pendaftaran_merek->status == 3)
                                <span class="mt-1 text-sm font-semibold text-white badge badge-error">Ditolak</span>
                            @elseif($pendaftaran_merek->status == 4)
                                <span class="mt-1 text-sm font-semibold text-white badge badge-success">Terdaftar</span>
                            @elseif($pendaftaran_merek->status == 5)
                                <span class="mt-1 text-sm font-semibold text-white badge badge-error">Dicabut</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="flex flex-col mt-4">
                    <span class="block mb-2 text-sm font-semibold text-neutral/80">Logo Merek</span>
                    <div
                        class="flex flex-col items-center justify-center h-64 max-w-xl overflow-hidden border bg-base-100 rounded-btn">
                        <img src="{{ asset('storage/logo_merek/' . $pendaftaran_merek->logo_merek) ?? asset('assets/images/img_not_found.png') }}"
                            alt="brand" class="object-contain w-auto h-full">
                    </div>
                </div>
                {{-- Nama Merek --}}
                <div class="px-4 py-4 mt-6 border bg-base-100 rounded-btn">
                    <span class="text-xs font-semibold text-neutral/80">Nama Merek</span>
                    <div class="flex flex-col mt-2">
                        <span
                            class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->nama_merek ?? '-' }}</span>
                    </div>
                </div>
                {{-- Detail --}}
                <span class="block mt-6 text-sm font-bold text-neutral/80">Detail</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-btn">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Nomor Pengumuman</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->nomor_pengumuman ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Tanggal Pengumuman</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->tanggal_pengumuman ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Nomor Pendaftaran</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->no_pendaftaran ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Tanggal Penerimaan</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->tanggal_pengumuman ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Tgl Dimulai Perlindungan</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->tanggal_dimulai_perlindungan ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Tgl Berakhir Perlindungan</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->tanggal_berakhir_perlindungan ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Translasi --}}
                <div class="px-4 py-4 mt-8 border bg-base-100 rounded-btn">
                    <span class="text-sm font-semibold text-neutral/80">Translasi</span>
                    <div class="flex flex-col mt-2">
                        <span
                            class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->translasi ?? '-' }}</span>
                    </div>
                </div>

                {{-- Kelas --}}
                <span class="block mt-8 mb-2 text-sm font-bold text-neutral/80">Kelas Nice</span>
                <div class="px-4 py-4 border bg-base-100 rounded-btn">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Jenis Barang / Jasa</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->jenis_barang_jasa ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Kode kelas</span>
                            <span
                                class="text-lg font-semibold text-neutral">{{ $pendaftaran_merek->kelas_barang_jasa ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Pemilik --}}
                <span class="block mt-8 text-sm font-bold text-neutral/80">Pemilik</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-btn">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Nama</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->pemohon ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Alamat</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->alamat_pemohon ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Kewarganegaraan</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->kewarganegaraan_pemohon ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Konsultan --}}
                <span class="block mt-8 text-sm font-bold text-neutral/80">Konsultan</span>
                <div class="px-4 py-4 mt-2 bg-base-200 rounded-btn">
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Nama</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->konsultan ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Alamat</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->alamat_konsultan ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        <div class="flex flex-col w-1/2">
                            <span class="text-sm font-semibold text-neutral/80">Kewarganegaraan</span>
                            <span
                                class="text-base font-semibold text-neutral">{{ $pendaftaran_merek->kewarganegaraan_konsultan ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('permohonan') }}" class="mt-6 btn text-ghost-content">
                    Kembali
                </a>
            </div>
        </div>
        <div class="mt-8">
            <livewire:dashboard.permohonan.admin.tindakan :nomorPermohonan="$pendaftaran_merek->no_permohonan" />
            <div class="mt-3">
                <div class="">
                    <button class="btn btn-neutral" onclick="ttd_pemohon.showModal()">Lihat Tanda Tangan
                        Pemohon</button>
                    <dialog id="ttd_pemohon" class="w-full modal">
                        <div class="max-w-xl modal-box">
                            <form method="dialog">
                                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                            </form>
                            {{-- <h3 class="text-lg font-bold">Hello!</h3>
                        <p class="py-4">Press ESC key or click on ✕ button to close</p> --}}
                            <div class="w-full h-full">
                                <span class="block mb-3 text-lg font-semibold">Tanda Tangan Pemohon</span>
                                <iframe
                                    src="{{ asset('storage/tanda_tangan_pemohon/' . $pendaftaran_merek->tanda_tangan_pemohon) }}"
                                    width="100%" height="600" class="rounded-btn">
                                    This browser does not support PDFs.
                                </iframe>
                            </div>
                        </div>
                    </dialog>
                </div>
                @if ($pendaftaran_merek->surat_keterangan_umk != null)
                    <div class="mt-3">
                        <button class="btn btn-neutral" onclick="surat_umk.showModal()">Lihat Surat Keterangan
                            UMK</button>
                        <dialog id="surat_umk" class="w-full modal">
                            <div class="max-w-7xl modal-box">
                                <form method="dialog">
                                    <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                                </form>
                                {{-- <h3 class="text-lg font-bold">Hello!</h3>
                        <p class="py-4">Press ESC key or click on ✕ button to close</p> --}}
                                <div class="w-full">
                                    <span class="block mb-3 text-lg font-semibold">Surat Keterangan UMK</span>
                                    <iframe
                                        src="{{ asset('storage/surat_keterangan_umk/' . $pendaftaran_merek->surat_keterangan_umk) }}"
                                        width="100%" height="700" class="rounded-btn">
                                        This browser does not support PDFs.
                                    </iframe>
                                </div>
                            </div>
                        </dialog>
                    </div>
                @endif
                <div class="mt-3">
                    <button class="btn btn-neutral" onclick="detail_pembuat_permohonan.showModal()">Lihat Akun
                        Pembuat Permohonan</button>
                    <dialog id="detail_pembuat_permohonan" class="w-full modal">
                        <div class="max-w-3xl modal-box">
                            <form method="dialog">
                                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                            </form>
                            <div class="max-w-3xl">
                                <div class="flex gap-x-8">
                                    <div class="mb-3">
                                        <div class="">
                                            <span class="text-base font-semibold">Avatar</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-center overflow-hidden rounded-full w-52 h-52">
                                            <img src="{{ auth()->user()->avatar != null ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar_male.png') }}"
                                                alt="" class="object-cover w-full h-full">
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full gap-x-4">
                                        <div class="w-full mb-3">
                                            <label class="w-full form-control">
                                                <div class="label">
                                                    <span class="text-base font-semibold label-text">Nama
                                                        Lengkap</span>
                                                </div>
                                                <span
                                                    class="block w-full p-3 font-semibold border border-neutral/20 rounded-btn">{{ auth()->user()->name ?? '-' }}</span>
                                            </label>
                                        </div>
                                        <div class="flex w-full mb-3 gap-x-4">
                                            <div class="flex-grow">
                                                <label class="w-full form-control">
                                                    <div class="label">
                                                        <span class="text-base font-semibold label-text">No.
                                                            Telepon</span>
                                                    </div>
                                                    <span
                                                        class="block w-full p-3 border border-neutral/20 rounded-btn">{{ auth()->user()->phone ?? '-' }}</span>
                                                </label>
                                            </div>
                                            <div class="">
                                                <label class="w-full form-control">
                                                    <div class="label">
                                                        <span class="text-base label-text">Tanggal Lahir</span>
                                                    </div>
                                                    <span
                                                        class="block w-full p-3 border border-neutral/20 rounded-btn">{{ auth()->user()->birth_date ?? '-' }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <label class="w-fit form-control">
                                                <div class="label">
                                                    <span name="nama_lengkap"
                                                        class="text-base font-semibold label-text">Jenis
                                                        Kelamin</span>
                                                </div>
                                                @if (auth()->user()->gender == 'l')
                                                    <span class="text-base font-semibold">Laki-laki</span>
                                                @else
                                                    <span class="text-base font-semibold">Perempuan</span>
                                                @endif

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex max-w-3xl gap-x-4">
                                    <div class="w-full mb-3">
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold label-text">Pekerjaan /
                                                    Jabatan</span>
                                            </div>
                                            <span
                                                class="block w-full p-3 border border-neutral/20 rounded-btn">{{ auth()->user()->job ?? '-' }}</span>
                                        </label>
                                    </div>
                                    <div class="w-full mb-3">
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold label-text">Perusahaan</span>
                                            </div>
                                            <span
                                                class="block w-full p-3 border border-neutral/20 rounded-btn">{{ auth()->user()->company ?? '-' }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="w-full max-w-3xl form-control">
                                        <div class="label">
                                            <span class="text-base font-semibold label-text">Bio</span>
                                        </div>
                                        <span
                                            class="block w-full p-3 border h-28 border-neutral/20 rounded-btn">{{ auth()->user()->bio ?? '-' }}</span>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="w-full max-w-3xl form-control">
                                        <div class="label">
                                            <span class="text-base font-semibold label-text">Alamat</span>
                                        </div>
                                        <span
                                            class="block w-full p-3 border h-28 border-neutral/20 rounded-btn">{{ auth()->user()->address ?? '-' }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </dialog>
                </div>
            </div>
        </div>
    </div>
</div>

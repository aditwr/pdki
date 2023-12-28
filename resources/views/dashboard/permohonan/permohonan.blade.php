@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl">
        {{-- Breadcrumbs --}}
        <div class="text-sm breadcrumbs">
            <ul>
                <li>
                    <x-breadcrumb href="{{ route('permohonan') }}" text="Permohonan" />
                </li>
            </ul>
        </div>

        <div class="flex justify-between w-full mt-8">
            <h1 class="text-3xl font-bold">
                Pengajuan Merek
            </h1>
            <a href="{{ route('permohonan.pendaftaran-merek') }}" class="btn btn-primary">Ajukan Pendaftaran Merek</a>
        </div>
        <div class="mt-8">
            @if (count($pendaftaran_mereks) > 0)
                <div x-data="{
                    deleteId: null,
                    deleteMerek: '',
                }" class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Merek</th>
                                        <th>Pemilik Merek</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendaftaran_mereks as $merek)
                                        <tr>
                                            <th>
                                                {{ $loop->iteration }}
                                            </th>
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="avatar">
                                                        <div class="flex items-center justify-center h-12 w-28 ">
                                                            <img src="{{ asset('storage/logo_merek/' . $merek->logo_merek) }}"
                                                                class="object-contain w-auto h-full"
                                                                alt="Avatar Tailwind CSS Component" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold">{{ $merek->nama_merek }}</div>
                                                        <span class="badge badge-ghost badge-sm"><span
                                                                class="font-semibold">
                                                                {{ $merek->no_permohonan }}</span></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $merek->pemohon }}
                                                <br />
                                                {{-- <span class="badge badge-ghost badge-sm">Desktop Support Technician</span> --}}
                                            </td>
                                            {{-- format date in indonesian --}}
                                            <td>
                                                {{ formatDate($merek->created_at) }}
                                            </td>

                                            <td>
                                                @if ($merek->status == 0)
                                                    <span
                                                        class="mt-1 text-sm font-semibold badge badge-neutral text-neutral-content">Menunggu
                                                        Verifikasi</span>
                                                @elseif($merek->status == 1)
                                                    <span
                                                        class="mt-1 text-sm font-semibold badge badge-warning text-neutral">Revisi</span>
                                                @elseif($merek->status == 2)
                                                    <span
                                                        class="mt-1 text-sm font-semibold badge badge-neutral text-neutral-content">Selesai
                                                        Revisi</span>
                                                @elseif($merek->status == 3)
                                                    <span
                                                        class="mt-1 text-sm font-semibold text-white badge badge-error">Ditolak</span>
                                                @elseif($merek->status == 4)
                                                    <span
                                                        class="mt-1 text-sm font-semibold text-white badge badge-success">Terdaftar</span>
                                                @elseif($merek->status == 5)
                                                    <span
                                                        class="mt-1 text-sm font-semibold text-white badge badge-error">Dicabut</span>
                                                @endif
                                            </td>
                                            <th class="flex items-center gap-x-4">
                                                <a href="{{ route('permohonan.pendaftaran-merek.show', $merek->no_permohonan) }}"
                                                    class="btn hover:btn-neutral">details</a>
                                                <div class="">
                                                    <!-- Open the modal using ID.showModal() method -->
                                                    <button class="btn btn-ghost"
                                                        @click="my_modal_1.showModal(); deleteMerek = '{{ $merek->nama_merek }}'; deleteId={{ $merek->id }}"><svg
                                                            class="w-4 h-4 text-error" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 18 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                        </svg></button>

                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        {{-- delete Modal --}}
                        <dialog id="my_modal_1" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">Konfirmasi Hapus</h3>
                                <p class="py-4">Apakah anda yakin ingin menghapus dan
                                    membatalkan
                                    permohonan pendaftaran
                                    merek <span x-text="deleteMerek" class="font-semibold"></span>
                                    ini?
                                </p>
                                <div class="modal-action">
                                    <form x-bind:action="'/permohonan/pendaftaran-merek/delete/' + deleteId" method="post">
                                        @csrf
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button type="submit" class="btn btn-error">Hapus</button>
                                        <button @click="my_modal_1.close()" type="button" class="btn">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        <div class="mt-4">
                            {{ $pendaftaran_mereks->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center w-full h-64">
                    <img src="{{ asset('assets/images/empty-box.png') }}" alt="" class="w-auto h-32">
                    <p class="mt-4 text-xl font-bold text-gray-500">Belum ada pengajuan merek</p>
                </div>
            @endif
        </div>
        @if (session('permohonan_merek_success'))
            <div class="items-center justify-between hidden gap-x-4" id="permohonan_success_toast">
                <div class="">
                    <svg class="w-auto h-10 text-neutral" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                        <path
                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                </div>
                <div class="">
                    <div class="flex justify-between">
                        <span class="text-lg font-normal">Pengajuan permohonan pendaftaran merek berhasil</span>
                    </div>
                    <div class="text-sm text-emerald-100">
                        Permohonan Merek <span
                            class="font-semibold text-white badge badge-neutral">{{ session('nama_merek') }}</span> dengan
                        nomor
                        permohonan
                        <span class="italic text-white">{{ session('no_permohonan') }}</span>
                        berhasil diajukan. Silahkan tunggu proses
                        verifikasi dari admin.
                    </div>
                </div>
            </div>
        @endif
        @if (session('revisi_permohonan_merek_success'))
            <div class="items-center justify-between hidden gap-x-4" id="revisi_permohonan_success_toast">
                <div class="">
                    <svg class="w-auto h-10 text-neutral" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                        <path
                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                </div>
                <div class="">
                    <div class="flex justify-between">
                        <span class="text-lg font-normal">Revisi permohonan pendaftaran merek berhasil!</span>
                    </div>
                    <div class="text-sm text-emerald-100">
                        Permohonan Merek <span
                            class="font-semibold text-white badge badge-neutral">{{ session('nama_merek') }}</span> dengan
                        nomor
                        permohonan
                        <span class="italic text-white">{{ session('no_permohonan') }}</span>
                        berhasil direvisi!. Silahkan tunggu proses
                        verifikasi dari admin.
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts_body')
    @if (session('permohonan_merek_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('permohonan_success_toast').style.display = 'flex';
                Toastify({
                    node: document.querySelector('#permohonan_success_toast'),
                    duration: -1,
                    destination: "{{ session('link') }}",
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#059669",
                        // boxShadow: "none",
                        width: "600px",
                        height: "auto",
                        borderRadius: "8px",
                        display: "flex",
                        alignItems: "start",
                        gap: "1rem",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            });
        </script>
    @endif
    @if (session('revisi_permohonan_merek_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('revisi_permohonan_success_toast').style.display = 'flex';
                Toastify({
                    node: document.querySelector('#revisi_permohonan_success_toast'),
                    duration: -1,
                    destination: "{{ session('link') }}",
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#059669",
                        // boxShadow: "none",
                        width: "600px",
                        height: "auto",
                        borderRadius: "8px",
                        display: "flex",
                        alignItems: "start",
                        gap: "1rem",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            });
        </script>
    @endif
    @if (session('delete_pendaftaran_merek_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: "{{ session('message') }}",
                    duration: -1,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#059669",
                        // boxShadow: "none",
                        // width: "600px",
                        height: "auto",
                        borderRadius: "8px",
                        display: "flex",
                        justifyItems: "space-between",
                        alignItems: "start",
                        gap: "1rem",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            });
        </script>
    @endif
    @if ($perlu_lengkapi_profil)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Lengkapi Data Profil",
                    text: "Untuk keperluan administrasi, silahkan lengkapi data profil anda. Layanan verifikasi permohonan hanya dapat dilakukan setelah data profil anda lengkap.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Lengkapi Sekarang",
                    cancelButtonText: "Lain Kali",

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('profil') }}";
                    }
                });
            });
        </script>
    @endif
@endpush

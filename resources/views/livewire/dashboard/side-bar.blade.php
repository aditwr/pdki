<div class="">
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 text-sm text-gray-500 rounded-lg ms-3 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto border bg-base-100">
            <div class="flex items-center w-full h-44 jusfity-center">
                <a href="" class="flex items-center justify-center w-full ">
                    <div class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full">
                        <img class=""
                            src="{{ auth()->user()->avatar != null ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar_male.png') }}"
                            alt="avatar">
                    </div>
                    <div class="ms-3">
                        <p class="text-base font-medium text-gray-800 dark:text-gray-200 line-clamp-1">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 line-clamp-1">
                            {{ auth()->user()->job ?? 'Job' }}
                        </p>
                    </div>
                </a>
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 rounded-lg  @if (Request::is('dashboard')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                        <svg class="w-5 h-5 @if (Request::is('dashboard')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                @if (!auth()->user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('permohonan') }}"
                            class="flex items-center p-2 rounded-lg  @if (Request::is('permohonan*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                            {{-- <svg class="w-5 h-5 @if (Request::is('permohonan*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg> --}}
                            <svg class="w-5 h-5 @if (Request::is('permohonan*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 20">
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            </svg>
                            <span class="ms-3">Permohonan</span>
                        </a>
                    </li>
                @endif
                @can('akses-admin')
                    <li>
                        <a href="{{ route('admin.permohonan') }}" wire:ignore
                            class="flex items-center p-2 rounded-lg  @if (Request::is('admin/permohonan*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                            {{-- <svg class="w-5 h-5 @if (Request::is('admin/permohonan*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg> --}}
                            <svg class="w-5 h-5 @if (Request::is('admin/permohonan*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                <path
                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Permohonan</span>
                            <span id="jumlah_permohonan_baru"
                                class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full ms-3 dark:bg-blue-900 dark:text-blue-300">{{ $jumlah_permohonan_baru }}</span>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('notifikasi.show') }}" wire:ignore
                        class="flex items-center p-2 rounded-lg  @if (Request::is('notifikasi**')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                        <svg class="w-5 h-5 @if (Request::is('notifikasi**')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M15.133 10.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V1.1a1 1 0 0 0-2 0v2.364a.944.944 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C4.867 13.018 3 13.614 3 14.807 3 15.4 3 16 3.538 16h12.924C17 16 17 15.4 17 14.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.39A1.001 1.001 0 1 1 4.854 3.8a7.431 7.431 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 15.146 3.8a1 1 0 0 1 1.471-1.354 9.425 9.425 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM6.823 17a3.453 3.453 0 0 0 6.354 0H6.823Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Notifikasi</span>
                        @if ($jumlah_notifikasi_belum_dibaca > 0)
                            <span id="jumlah_notifikasi_belum_dibaca"
                                class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full ms-3 dark:bg-blue-900 dark:text-blue-300">{{ $jumlah_notifikasi_belum_dibaca }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengumuman') }}" wire:ignore
                        class="flex items-center p-2 rounded-lg  @if (Request::is('pengumuman*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                        <svg class="w-5 h-5 @if (Request::is('pengumuman*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M20 3H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L12.414 16H20a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2ZM7.5 11a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm4.5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm4.5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Pengumuman</span>
                        @if ($pengumuman_aktif > 0)
                            <span id="jumlah_notifikasi_belum_dibaca"
                                class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full ms-3 dark:bg-blue-900 dark:text-blue-300">{{ $pengumuman_aktif }}</span>
                        @endif
                    </a>
                </li>
                @can('akses-admin')
                    <li>
                        <a href="{{ route('laporan.pendaftaran-merek') }}" wire:ignore
                            class="flex items-center p-2 rounded-lg  @if (Request::is('laporan*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                            <svg class="w-5 h-5 @if (Request::is('laporan*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M9 7V2.13a2.98 2.98 0 0 0-1.293.749L4.879 5.707A2.98 2.98 0 0 0 4.13 7H9Z" />
                                <path
                                    d="M18.066 2H11v5a2 2 0 0 1-2 2H4v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 20 20V4a1.97 1.97 0 0 0-1.934-2ZM10 18a1 1 0 1 1-2 0v-2a1 1 0 1 1 2 0v2Zm3 0a1 1 0 0 1-2 0v-6a1 1 0 1 1 2 0v6Zm3 0a1 1 0 0 1-2 0v-4a1 1 0 1 1 2 0v4Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Laporan</span>
                        </a>
                    </li>
                @endcan
                @can('akses-admin')
                    <li>
                        <a href="{{ route('pengelolaan.user') }}" wire:ignore
                            class="flex items-center p-2 rounded-lg  @if (Request::is('pengelolaan/user*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                            <svg class="w-5 h-5 @if (Request::is('pengelolaan/user*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm-1.391 7.361.707-3.535a3 3 0 0 1 .82-1.533L7.929 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h4.259a2.975 2.975 0 0 1-.15-1.639ZM8.05 17.95a1 1 0 0 1-.981-1.2l.708-3.536a1 1 0 0 1 .274-.511l6.363-6.364a3.007 3.007 0 0 1 4.243 0 3.007 3.007 0 0 1 0 4.243l-6.365 6.363a1 1 0 0 1-.511.274l-3.536.708a1.07 1.07 0 0 1-.195.023Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Kelola User</span>
                            @if ($users_need_verification > 0)
                                <span id="jumlah_notifikasi_belum_dibaca"
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full ms-3 dark:bg-blue-900 dark:text-blue-300">{{ $users_need_verification }}</span>
                            @endif
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('profil') }}"
                        class="flex items-center p-2 rounded-lg  @if (Request::is('profil*')) bg-neutral text-neutral-content @else hover:bg-gray-100 dark:hover:bg-gray-700 text-neutral/95 dark:text-white @endif  group">
                        <svg class="w-5 h-5 @if (Request::is('profil*')) text-neutral-content @else text-gray-600 dark:text-gray-400 group-hover:text-neutral/95 dark:group-hover:text-white @endif  transition duration-75  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 14 18">
                            <path
                                d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="ms-3">Profil</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
@push('scripts_body')
    <script>
        window.addEventListener('jumlah_notifikasi_belum_dibaca', event => {
            let notifikasi = document.getElementById('jumlah_notifikasi_belum_dibaca');
            notifikasi.innerHTML = event.detail[0];
        })
        window.addEventListener('jumlah_permohonan_baru', event => {
            let notifikasi = document.getElementById('jumlah_permohonan_baru');
            notifikasi.innerHTML = event.detail[0];
        })
    </script>
@endpush

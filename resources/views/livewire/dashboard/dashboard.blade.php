<div class="mt-8 scroll-smooth">
    {{-- Stats --}}
    <div class="">
        <div class="mb-8 shadow stats">
            @can('akses-admin')
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                    </div>
                    <div class="stat-title text-neutral/90">Permohonan</div>
                    <div class="stat-value text-primary">{{ $permohonan_perlu_verifikasi }}</div>
                    <div class="stat-desc">perlu verifikasi</div>
                </div>
            @endcan
            @if (!auth()->user()->hasRole('admin'))
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                    </div>
                    <div class="stat-title text-neutral/90">Permohonan</div>
                    <div class="stat-value text-primary">{{ $permohonan_menunggu_verifikasi }}</div>
                    <div class="stat-desc">menunggu verifikasi!</div>
                </div>
            @endif
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M15.133 10.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V1.1a1 1 0 0 0-2 0v2.364a.944.944 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C4.867 13.018 3 13.614 3 14.807 3 15.4 3 16 3.538 16h12.924C17 16 17 15.4 17 14.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.39A1.001 1.001 0 1 1 4.854 3.8a7.431 7.431 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 15.146 3.8a1 1 0 0 1 1.471-1.354 9.425 9.425 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM6.823 17a3.453 3.453 0 0 0 6.354 0H6.823Z" />
                    </svg>
                </div>
                <div class="stat-title text-neutral/90">Notifikasi</div>
                <div class="stat-value text-secondary">{{ $notifikasi_belum_dibaca }}</div>
                <div class="stat-desc">Notifikasi belum dibaca</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M20 3H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L12.414 16H20a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2ZM7.5 11a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm4.5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm4.5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z" />
                    </svg>
                </div>
                <div class="stat-title text-neutral/90">Pengumuman</div>
                <div class="stat-value">{{ $jumlah_pengumuman_aktif }}</div>
                <div class="stat-desc">Pengumuman aktif</div>
            </div>

            {{-- <div class="stat">
                <div class="stat-figure text-secondary">
                    <div class="avatar online">
                        <div class="w-16 rounded-full">
                            <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </div>
                </div>
                <div class="stat-value">86%</div>
                <div class="stat-title text-neutral/90">Tasks done</div>
                <div class="stat-desc text-secondary">31 tasks remaining</div>
            </div> --}}

        </div>
    </div>

    {{-- Pengumuman --}}
    <span class="block mb-2 text-xl font-semibold">Pengumuman</span>
    <div class="mb-12">
        @if (count($pengumuman_aktif) > 0)
            <div class="w-full max-w-4xl h-72 carousel">
                @foreach ($pengumuman_aktif as $pengumuman)
                    <div id="slide{{ $loop->iteration }}" class="relative w-full carousel-item">
                        <div
                            class="flex flex-col justify-center w-full h-full py-6 overflow-y-auto border bg-base-200 px-28 rounded-btn">
                            <div class="mb-4">
                                <h5 class="font-semibold text-md badge badge-neutral">
                                    {{ $pengumuman->judul_pengumuman }}
                                </h5>
                            </div>
                            <article class="prose prose-p:leading-tight">
                                {!! $pengumuman->isi_pengumuman !!}
                            </article>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            @if ($loop->iteration > 1)
                                <a href="#slide{{ $loop->iteration - 1 }}" class="btn btn-circle">❮</a>
                            @else
                                <a href="#slide{{ $loop->count }}" class="btn btn-circle">❮</a>
                            @endif
                            @if ($loop->iteration == $loop->count)
                                <a href="#slide1" class="btn btn-circle">❯</a>
                            @else
                                <a href="#slide{{ $loop->iteration + 1 }}" class="btn btn-circle">❯</a>
                            @endif
                        </div>
                    </div>\
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center w-full h-64 max-w-4xl bg-base-200">
                <img src="{{ asset('assets/images/empty-box.png') }}" alt="" class="w-auto h-32">
                <p class="mt-4 text-xl font-bold text-gray-500">Tidak ada pengumuman saat ini</p>
            </div>
        @endif
    </div>

    {{-- Charts --}}
    <div class="grid w-full grid-cols-3 gap-x-4">
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Grafik Permohonan Harian</span>
            <canvas id="chart1" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Grafik Permohonan Bulanan</span>
            <canvas id="chart2" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Grafik Permohonan Tahunan</span>
            <canvas id="chart3" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
    </div>
    <div class="flex w-full mt-8 gap-x-4">
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Akses Member Harian</span>
            <canvas id="chart4" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Akses Member Bulanan</span>
            <canvas id="chart5" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
        <div class="flex-grow h-64 p-4 pb-12 border rounded-btn">
            <span class="block mb-2 text-xl font-semibold">Akses Member Tahunan</span>
            <canvas id="chart6" aria-label="Hello ARIA World" role="img"></canvas>
        </div>
    </div>

</div>
@push('scripts_body')
    <script>
        const chart1 = document.getElementById('chart1').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: {{ json_encode($daftar_tanggal_bulan_ini) }},
                datasets: [{
                    label: 'Permohonan Masuk',
                    data: {{ json_encode($permohonan_masuk_bulan_ini) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart1, config);
        });
    </script>
    <script>
        const chart2 = document.getElementById('chart2').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ],
                datasets: [{
                    label: 'Permohonan Masuk',
                    data: {{ json_encode($permohonan_bulanan) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart2, config);
        });
    </script>
    <script>
        const chart3 = document.getElementById('chart3').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: {{ json_encode($daftar_tahun) }},
                datasets: [{
                    label: 'Permohonan Masuk',
                    data: {{ json_encode($permohonan_tahunan) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart3, config);
        });
    </script>

    <script>
        const chart4 = document.getElementById('chart4').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: {{ json_encode($daftar_tanggal_bulan_ini) }},
                datasets: [{
                    label: 'Jumlah Akses Member',
                    data: {{ json_encode($akses_member_harian) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart4, config);
        });
    </script>
    <script>
        const chart5 = document.getElementById('chart5').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ],
                datasets: [{
                    label: 'Jumlah Akses Member',
                    data: {{ json_encode($akses_member_bulanan) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart5, config);
        });
    </script>
    <script>
        const chart6 = document.getElementById('chart6').getContext('2d');
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: {{ json_encode($daftar_tahun) }},
                datasets: [{
                    label: 'Jumlah Akses Member',
                    data: {{ json_encode($akses_member_tahunan) }},
                    fill: false,
                    borderColor: '#10b981',
                    tension: 0.1,
                    // set background color
                    backgroundColor: '#10b981',
                }]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };

            const chart = new Chart(chart6, config);
        });
    </script>
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

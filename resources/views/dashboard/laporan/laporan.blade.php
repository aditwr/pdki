@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-8xl">
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
                Laporan
            </h1>
            <a href="{{ '/laporan/pendaftaran-merek/cetakpdf?tanggalAwal=' . $tanggalAwal . '&tanggalAkhir=' . $tanggalAkhir }}"
                class="btn btn-primary">Cetak Laporan</a>
        </div>
        <div class="">
            <div class="">
                <div class="mt-8">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <form action="{{ route('laporan.pendaftaran-merek') }}" method="GET">
                                <div class="flex items-baseline mb-4 gap-x-4">
                                    <div class="">
                                        <label class="mb-3 form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold label-text">Tanggal Awal</span>
                                            </div>
                                            <input name='tanggalAwal' id="" type="date"
                                                value="{{ $tanggalAwal ?? '' }}" class="input input-bordered" />
                                        </label>
                                    </div>
                                    <div class="">
                                        <label class="mb-3 form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold label-text">Tanggal Akhir</span>
                                            </div>
                                            <input name='tanggalAkhir' id="" type="date"
                                                value="{{ $tanggalAkhir ?? '' }}" class="input input-bordered" />
                                        </label>
                                    </div>
                                    <div class="">
                                        <label class="mb-3 form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold opacity-0 label-text">Reset</span>
                                            </div>
                                            <button type="submit" class="btn btn-neutral">Gunakan
                                                Filter</button>
                                        </label>
                                    </div>
                                    <div class="">
                                        <label class="mb-3 form-control">
                                            <div class="label">
                                                <span class="text-base font-semibold opacity-0 label-text">Reset</span>
                                            </div>
                                            <a href="{{ route('laporan.pendaftaran-merek') }}" class="btn btn-neutral">Reset
                                                Filter</a>
                                        </label>
                                    </div>
                                </div>
                            </form>
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden border-b border-gray-200 shadow-md sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    No
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    No Permohonan
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Nama Merek
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Nama Pemohon
                                                </th>

                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Kelas
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Status
                                                </th>

                                                <th
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Tanggal Permohonan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($pendaftaran_mereks as $item)
                                                <tr>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $item->no_permohonan }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-semibold text-gray-500 whitespace-nowrap">
                                                        {{ $item->nama_merek }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $item->pemohon }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $item->kelas_barang_jasa }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        @if ($item->status == 0)
                                                            <span class="mt-1 text-sm text-gray-500">Menunggu
                                                                Verifikasi</span>
                                                        @elseif($item->status == 1)
                                                            <span class="mt-1 text-sm text-gray-500">Revisi</span>
                                                        @elseif($item->status == 2)
                                                            <span class="mt-1 text-sm text-gray-500">Selesai
                                                                Revisi</span>
                                                        @elseif($item->status == 3)
                                                            <span class="mt-1 text-sm text-gray-500">Ditolak</span>
                                                        @elseif($item->status == 4)
                                                            <span class="mt-1 text-sm text-gray-500">Terdaftar</span>
                                                        @elseif($item->status == 5)
                                                            <span class="mt-1 text-sm text-gray-500">Dicabut</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ formatDate($item->created_at) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <div class="p-2">
                                        {{ $pendaftaran_mereks->links() }}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

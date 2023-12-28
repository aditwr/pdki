@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-5xl">
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
                Pengumuman
            </h1>
            @can('akses-admin')
                <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">Buat Pengumuman</a>
            @endcan
        </div>
        <div class="">
            <livewire:dashboard.pengumuman.lihat />
        </div>
    </div>
@endsection
@push('scripts_body')
    @if (session('pengumuman_success'))
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
@endpush

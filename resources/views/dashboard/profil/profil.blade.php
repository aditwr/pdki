@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-3xl">
        {{-- Breadcrumbs --}}
        <div class="text-sm breadcrumbs">
            <ul>
                <li>
                    <x-breadcrumb href="{{ route('profil') }}" text="Profil" />
                </li>
            </ul>
        </div>

        <div class="flex justify-between w-full mt-8">
            <h1 class="text-3xl font-bold">
                Profil Saya
            </h1>
            <a href="{{ route('profil.edit') }}" class="btn btn-primary">Ubah Profil</a>
        </div>

        <div class="max-w-3xl">
            <div class="flex gap-x-8">
                <div class="mb-3">
                    <div class="">
                        <span class="text-base font-semibold">Avatar</span>
                    </div>
                    <div class="flex items-center justify-center overflow-hidden rounded-full w-52 h-52">
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
                                <span name="nama_lengkap" class="text-base font-semibold label-text">Jenis
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
                            <span class="text-base font-semibold label-text">Pekerjaan / Jabatan</span>
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
@endsection
@push('scripts_body')
    @if (session('update_profile_success'))
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

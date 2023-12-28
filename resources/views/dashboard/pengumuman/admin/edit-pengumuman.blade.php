@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-6xl">
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
                Edit Pengumuman
            </h1>
        </div>
        <div class="mt-8">
            <form action="{{ route('pengumuman.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $pengumuman->id }}">
                <div class="p-6 border bg-base-200 rounded-btn ">
                    <div class="mb-3">
                        <x-dashboard.form.text-input name="judul_pengumuman" label="Judul Pengumuman"
                            value="{{ $pengumuman->judul_pengumuman }}" placeholder="Judul Pengumuman" required />
                    </div>
                    <div class="mb-3">
                        <div class="label">
                            <span class="text-base font-semibold label-text">Isi Pengumuman</span>
                        </div>
                        <textarea name="isi_pengumuman" id="isi_pengumuman" cols="30" rows="10">{{ $pengumuman->isi_pengumuman ?? '' }}</textarea>
                    </div>
                    <div class="flex mb-3 gap-x-8">
                        <div class="">
                            <div class="label">
                                <span class="text-base font-semibold label-text">Tanggal Awal Pengumuman</span>
                            </div>
                            <input type="date" value="{{ $pengumuman->tanggal_awal_pengumuman }}"
                                name="tanggal_awal_pengumuman" class="input input-bordered" required>
                        </div>
                        <div class="">
                            <div class="label">
                                <span class="text-base font-semibold label-text">Tanggal Akhir Pengumuman</span>
                            </div>
                            <input type="date" value="{{ $pengumuman->tanggal_akhir_pengumuman }}"
                                name="tanggal_akhir_pengumuman" class="input input-bordered" required>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.tiny.cloud/1/9fdxmwc8bgyw07t5mlpf6rt09hdcxgln0ce5e3jniqd1emb0/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#isi_pengumuman', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>
    </div>
@endsection

@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('navbar', false)

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen ">
            {{-- verification notice --}}
            <div class="p-8 bg-base-100 rounded-badge">
                <p class="mb-4 font-medium text-center">Akun anda sudah dibuat, mohon tunggu admin untuk memverifikasi akun
                    anda sebelum bisa menjadi pemohon</p>

                {{-- <div class="flex flex-col justify-center w-full">
                    @if (session('message'))
                        <div class="w-full p-3 text-center alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('verification.send') }}" method="post" class="flex justify-center w-full">
                        @csrf
                        <button type="submit" class="btn btn-primary">Kirim Ulang Link Verifikasi</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

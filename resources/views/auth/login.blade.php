@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('navbar', false)

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen ">
            {{-- Login Form Component --}}
            <livewire:auth.login-form />
        </div>
    </div>
@endsection

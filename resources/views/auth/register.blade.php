@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('navbar', false)

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen ">
            {{-- Register Form Component --}}
            <livewire:auth.register-form />
        </div>
    </div>
@endsection

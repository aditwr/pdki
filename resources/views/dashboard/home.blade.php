@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-8xl">
        {{-- Breadcrumbs --}}
        <div class="text-sm breadcrumbs">
            <ul>
                <li>
                    <x-breadcrumb href="{{ route('dashboard') }}" text="Dashboard" />
                </li>
            </ul>
        </div>

        <div class="flex justify-between w-full mt-8">
            <h1 class="text-3xl font-bold">
                Dashboard
            </h1>
            {{-- <a href="{{ route('permohonan.pendaftaran-merek') }}" class="btn btn-primary">Ajukan Pendaftaran Merek</a> --}}
        </div>
        <div class="mt-8">
            <livewire:dashboard.dashboard />
        </div>
    </div>
@endsection

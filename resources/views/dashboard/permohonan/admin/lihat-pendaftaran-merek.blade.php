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

        <div class="">
            <livewire:dashboard.permohonan.admin.detail :pendaftaran_merek="$pendaftaran_merek" />
        </div>
    </div>
@endsection

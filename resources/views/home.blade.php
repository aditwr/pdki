@extends('layouts.app')

@section('title')
    Home
@endsection

@section('navbar', true)

@section('content')
    <livewire:guest.dashboard />
@endsection

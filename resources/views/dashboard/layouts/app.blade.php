<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @livewireStyles
    @stack('scripts_header')
</head>

<body>
    <div class="">
        <livewire:dashboard.side-bar />

        <div class="p-4 sm:ml-64">
            @yield('content')
        </div>
    </div>


    @livewireScripts
    @stack('scripts_body')
</body>

</html>

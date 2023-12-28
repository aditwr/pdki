<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light" class="scroll-smooth">

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
    @hasSection('navbar')
        {{-- Navbar --}}
        <div class="navbar bg-base-100">
            <div class="container">
                <div class="flex-1">
                    <a class="text-xl btn btn-ghost">PDKI</a>
                </div>
                <div class="flex-none">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-neutral text-neutral-content">
                            <div class="flex items-center gap-x-2">
                                <svg class="w-4 h-4 text-neutral-content dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-neutral text-neutral-content">
                            <div class="flex items-center gap-x-2">
                                <svg class="w-4 h-4 text-neutral-content dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                                </svg>
                                <span>Login</span>
                            </div>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-neutral text-neutral-content">
                            <div class="flex items-center gap-x-2">
                                <svg class="w-4 h-4 text-neutral-content dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                                </svg>
                                <span>Register</span>
                            </div>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        {{-- End of Navbar --}}
    @endif

    <div class="container">
        @yield('content')
    </div>


    @livewireScripts
    @stack('scripts_body')
</body>

</html>

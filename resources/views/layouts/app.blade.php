<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.x/dist/cdn.min.js"></script>

        <style>
            .sidebar-link { transition: all 0.18s; }
            .sidebar-link:hover { background: rgba(108,99,255,.05); color: #6C63FF; }
            .sidebar-link.active { background: rgba(108,99,255,.1); color: #6C63FF; border-right: 3px solid #6C63FF; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
        
        <div class="flex h-screen overflow-hidden">
            
            {{-- ===== OVERLAY SIDEBAR DI MOBILE ===== --}}
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" 
                 class="fixed inset-0 bg-black/40 z-30 lg:hidden" style="display: none;"></div>

            {{-- ===== SIDEBAR MENU (Kiri) ===== --}}
            @include('layouts.sidebar')

            {{-- ===== AREA KONTEN UTAMA (Kanan) ===== --}}
            <div class="flex-1 flex flex-col overflow-hidden min-w-0">
                
                {{-- Topbar bawaan Laravel Breeze + Tombol Hamburger Menu --}}
                <div class="flex items-center bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 pr-4">
                    <button @click="sidebarOpen = true" class="lg:hidden ml-4 w-9 h-9 rounded-xl bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                        <i class="fa-solid fa-bars text-sm"></i>
                    </button>
                    
                    <div class="flex-1">
                        @include('layouts.navigation')
                    </div>
                </div>

                {{-- Page Heading (Jika Ada) --}}
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow-sm z-10">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{-- Konten Utama ($slot) dengan Scrollbar Mandiri --}}
                <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>

    </body>
</html>
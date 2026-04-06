<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mega Shop | Teal Edition</title>

        <!-- SEO & Social Media Meta Tags -->
        <meta name="description" content="Mega Shop | Teal Edition: Descubre el equilibrio perfecto entre diseño y utilidad.">
        <meta property="og:title" content="Mega Shop | Teal Edition">
        <meta property="og:description" content="Descubre el equilibrio perfecto entre diseño y utilidad en Mega Shop.">
        <meta property="og:image" content="{{ asset('preview.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Mega Shop | Teal Edition">
        <meta name="twitter:description" content="Descubre el equilibrio perfecto entre diseño y utilidad en Mega Shop.">
        <meta name="twitter:image" content="{{ asset('preview.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                        colors: {
                            brand: { 50: '#f0fdfa', 100: '#ccfbf1', 500: '#14b8a6', 600: '#0d9488', 900: '#134e4a' }
                        },
                        animation: {
                            'blob': 'blob 10s infinite',
                        },
                        keyframes: {
                            blob: {
                                '0%': { transform: 'translate(0px, 0px) scale(1)' },
                                '33%': { transform: 'translate(40px, -60px) scale(1.2)' },
                                '66%': { transform: 'translate(-30px, 30px) scale(0.8)' },
                                '100%': { transform: 'translate(0px, 0px) scale(1)' },
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            .bg-texture {
                background-color: #f8fafc;
                background-image: radial-gradient(#14b8a6 0.5px, transparent 0.5px);
                background-size: 24px 24px;
                background-attachment: fixed;
            }
            .bg-grain {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                pointer-events: none; z-index: 50; opacity: 0.03;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            }
            .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-texture h-full overflow-x-hidden">
        <div class="bg-grain hidden md:block"></div>
        <div class="fixed top-0 -left-20 w-96 h-96 bg-brand-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-10 animate-blob pointer-events-none hidden md:block"></div>
        <div class="fixed bottom-0 -right-20 w-96 h-96 bg-brand-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-10 animate-blob animation-delay-2000 pointer-events-none hidden md:block"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 px-4">
            <div class="mb-10 scale-110 sm:scale-125">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/80 backdrop-blur-xl shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] border border-white overflow-hidden rounded-[2.5rem]">
                {{ $slot }}
            </div>
        </div>

        {{-- Power Bar Slim - Unified with App Layout --}}
        <div class="fixed bottom-0 left-0 right-0 z-[100] bg-slate-900 text-white py-3 px-4 shadow-[0_-10px_40px_rgba(0,0,0,0.3)]">
            <a href="https://yeib.cl" target="_blank" class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2 text-[10px] sm:text-sm font-bold tracking-tight text-center">
                <div class="flex items-center gap-2">
                    <span class="text-brand-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </span>
                    <span>{{ __('messages.yeib_banner_text') }}</span>
                </div>
                <span class="hidden sm:inline opacity-30">—</span>
                <span class="bg-brand-500 text-white px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest animate-pulse">{{ __('messages.learn_more') }}</span>
            </a>
        </div>

        <style>
            body { padding-bottom: 70px !important; }
            @media (max-width: 640px) {
                body { padding-bottom: 80px !important; }
            }
        </style>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Mega Shop | Teal Edition</title>

    <!-- SEO & Social Media Meta Tags -->
    <meta name="description" content="Mega Shop | Teal Edition: Descubre el equilibrio perfecto entre diseño y utilidad.">
    <meta property="og:title" content="Mega Shop | Teal Edition">
    <meta property="og:description" content="Descubre el equilibrio perfecto entre diseño y utilidad en Mega Shop.">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mega Shop | Teal Edition">
    <meta name="twitter:description" content="Descubre el equilibrio perfecto entre diseño y utilidad en Mega Shop.">
    <meta name="twitter:image" content="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(40px, -60px) scale(1.2)' },
                            '66%': { transform: 'translate(-30px, 30px) scale(0.8)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .bg-texture {
            background-color: #f8fafc;
            background-image: radial-gradient(#14b8a6 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            background-attachment: fixed;
        }
        .dark .bg-texture { background-color: #020617; background-image: radial-gradient(#14b8a6 0.5px, transparent 0.5px); }
        .bg-grain {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 50; opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        .dark .glass { background: rgba(13, 148, 136, 0.05); backdrop-filter: blur(20px); }
        .text-gradient { 
            background: linear-gradient(to right, #0d9488, #14b8a6); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent;
            padding-right: 0.15em; /* Prevent clipping */
        }
        .italic { padding-right: 0.05em; } /* Prevent italic clipping */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="h-full bg-texture text-slate-900 dark:text-slate-100 transition-colors duration-700 antialiased overflow-x-hidden">
    <div class="bg-grain hidden md:block"></div>
    
    <div class="min-h-full flex flex-col relative z-10">
        <nav x-data="{ openUserMenu: false }" class="glass sticky top-0 z-50 border-b border-brand-500/10 dark:border-brand-500/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 sm:h-20 items-center">
                    <!-- LOGO -->
                    <div class="flex items-center shrink-0">
                        <a href="{{ route('home') }}" class="hover:scale-105 transition-transform shrink-0">
                            <img src="{{ asset('logo.png') }}" alt="Mega Shop" class="h-10 sm:h-12 w-auto object-contain">
                        </a>
                    </div>

                    <!-- BOTONES DERECHA -->
                    <div class="flex items-center gap-2 sm:gap-4">
                        <!-- Lang Switcher -->
                        <div class="flex items-center bg-slate-100/50 dark:bg-brand-900/20 p-1 rounded-full text-[8px] sm:text-[9px] font-black border border-brand-500/10">
                            <a href="{{ route('lang.switch', 'es') }}" class="px-2 py-1 rounded-full transition-all {{ app()->getLocale() == 'es' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/20' : 'text-slate-400 hover:text-brand-500' }}">ES</a>
                            <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 rounded-full transition-all {{ app()->getLocale() == 'en' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/20' : 'text-slate-400 hover:text-brand-500' }}">EN</a>
                        </div>

                        <!-- Dark Mode Toggle -->
                        <button onclick="document.documentElement.classList.toggle('dark')" class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full border border-brand-500/20 dark:border-brand-500/40 hover:bg-brand-500 hover:text-white transition-all duration-500 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 hidden dark:block text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" /></svg>
                        </button>

                        <!-- USER MENU / AUTH -->
                        <div class="relative">
                            @auth
                                <button @click="openUserMenu = !openUserMenu" class="flex items-center gap-1 sm:gap-2 bg-slate-100 dark:bg-slate-800 p-1 sm:p-2 rounded-2xl border border-brand-500/10 hover:border-brand-500 transition-all shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center shadow-lg shadow-brand-500/20 relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        @if(($pendingTicketsCount ?? 0) + ($unseenTicketsCount ?? 0) > 0)
                                            <span class="absolute -top-1.5 -right-1.5 bg-amber-500 text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border-2 border-slate-100 dark:border-slate-800 animate-pulse min-w-[1.2rem] h-[1.2rem] flex items-center justify-center leading-none">
                                                {{ ($pendingTicketsCount ?? 0) + ($unseenTicketsCount ?? 0) }}
                                            </span>
                                        @endif
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-slate-400 transition-transform" :class="openUserMenu ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="openUserMenu" 
                                     @click.away="openUserMenu = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     class="absolute right-0 mt-3 w-64 bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-slate-800 py-4 z-50 overflow-hidden" x-cloak>
                                    
                                    <div class="px-6 py-3 border-b border-slate-50 dark:border-slate-800 mb-2">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ __('Hola,') }}</p>
                                        <p class="text-sm font-black text-brand-600 truncate">{{ Auth::user()->name }}</p>
                                    </div>

                                    @if(Auth::user()->role === 'admin')
                                        <div class="px-6 py-2 bg-slate-50 dark:bg-slate-800/50 mb-2">
                                            <p class="text-[8px] font-black uppercase tracking-widest text-brand-600 mb-2">{{ __('Administración') }}</p>
                                            <div class="grid grid-cols-2 gap-2">
                                                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-white dark:hover:bg-slate-900 transition-all border border-transparent hover:border-brand-500/10">
                                                    <div class="w-7 h-7 rounded-lg bg-slate-900 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg></div>
                                                    <span class="text-[8px] font-black uppercase">{{ __('Stats') }}</span>
                                                </a>
                                                <a href="{{ route('admin.categories') }}" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-white dark:hover:bg-slate-900 transition-all border border-transparent hover:border-brand-500/10">
                                                    <div class="w-7 h-7 rounded-lg bg-brand-500 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></div>
                                                    <span class="text-[8px] font-black uppercase">{{ __('Categorías') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <a href="{{ route('cart.index') }}" class="flex items-center justify-between px-6 py-3 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg></div>
                                            <span class="text-xs font-bold uppercase tracking-widest">{{ __('messages.cart') }}</span>
                                        </div>
                                        @if(session('cart'))
                                            <span class="bg-brand-500 text-white text-[8px] font-black px-2 py-1 rounded-full">{{ count(session('cart')) }}</span>
                                        @endif
                                    </a>

                                    <a href="{{ route('wishlist.index') }}" class="flex items-center justify-between px-6 py-3 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg></div>
                                            <span class="text-xs font-bold uppercase tracking-widest">{{ __('messages.wishlist') }}</span>
                                        </div>
                                        @if(Auth::user()->wishlists()->count() > 0)
                                            <span class="bg-rose-500 text-white text-[8px] font-black px-2 py-1 rounded-full">{{ Auth::user()->wishlists()->count() }}</span>
                                        @endif
                                    </a>

                                    <a href="{{ route('orders.index') }}" class="flex items-center gap-4 px-6 py-3 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg></div>
                                        <span class="text-xs font-bold uppercase tracking-widest">{{ __('messages.orders') }}</span>
                                    </a>

                                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.tickets.index') : route('tickets.index') }}" class="flex items-center justify-between px-6 py-3 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg></div>
                                            <span class="text-xs font-bold uppercase tracking-widest">{{ __('messages.tickets') }}</span>
                                        </div>
                                        @if(Auth::user()->role === 'admin' && $pendingTicketsCount > 0)
                                            <span class="bg-amber-500 text-white text-[8px] font-black px-2 py-1 rounded-full animate-pulse">{{ $pendingTicketsCount }}</span>
                                        @endif
                                        @if($unseenTicketsCount > 0)
                                            <span class="bg-amber-500 text-white text-[8px] font-black px-2 py-1 rounded-full animate-pulse">{{ $unseenTicketsCount }}</span>
                                        @endif
                                    </a>

                                    <div class="mt-2 pt-2 border-t border-slate-50 dark:border-slate-800">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-4 px-6 py-3 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-rose-500 transition-colors">
                                                <div class="w-8 h-8 rounded-lg bg-rose-500/10 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg></div>
                                                <span class="text-xs font-black uppercase tracking-widest">{{ __('Salir') }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase bg-slate-100 dark:bg-slate-800 px-4 py-2.5 rounded-xl hover:text-brand-500 transition-all shrink-0">{{ __('Entrar') }}</a>
                                    <a href="{{ route('register') }}" class="hidden sm:block text-[10px] font-black uppercase bg-brand-500 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-brand-500/20 hover:bg-brand-600 transition-all shrink-0">{{ __('Registro') }}</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12 w-full animate-fade-in-up">
            @if(session('success'))
                <div class="mb-10 p-5 bg-brand-500/10 border border-brand-500/20 text-brand-600 dark:text-brand-400 rounded-3xl font-bold flex items-center gap-4 backdrop-blur-sm shadow-2xl shadow-brand-500/5">
                    <div class="bg-brand-500 text-white p-2 rounded-xl shadow-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-10 p-5 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-3xl font-bold flex items-center gap-4 backdrop-blur-sm shadow-2xl shadow-rose-500/5">
                    <div class="bg-rose-500 text-white p-2 rounded-xl shadow-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></div>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="bg-teal-50/50 dark:bg-brand-900/10 border-t border-brand-500/10 py-24 mt-20 relative overflow-x-hidden text-center">
            <h3 class="text-3xl font-black italic text-gradient tracking-tighter mb-2">Mega Shop</h3>
            <a href="mailto:yeib@pm.me" class="text-xs font-bold text-teal-600 dark:text-teal-400 mb-8 lowercase italic hover:underline">yeib@pm.me</a>
            <div class="flex justify-center gap-10 text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-12 mt-8">
                <a href="{{ route('pages.terms') }}" class="hover:text-brand-500 transition-colors">{{ __('Terms') }}</a>
                <span class="hover:text-brand-500 cursor-pointer transition-colors">Quality</span>
                <span class="hover:text-brand-500 cursor-pointer transition-colors">Minimalism</span>
            </div>
            <div class="text-[9px] font-black uppercase tracking-[0.5em] text-brand-500/40">
                &copy; {{ date('Y') }} Crafted with the Teal Signature.
            </div>
        </footer>
    </div>

    <!-- POWER BAR -->
    <div class="fixed bottom-0 left-0 right-0 z-[100] bg-slate-900 text-white py-3 px-4 shadow-[0_-10px_40px_rgba(0,0,0,0.3)]">
        <a href="https://yeib.cl" target="_blank" class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2 text-[10px] sm:text-sm font-bold tracking-tight text-center transition-all hover:text-brand-400">
            <div class="flex items-center gap-2">
                <span class="text-brand-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
                <span class="whitespace-nowrap">{{ __('messages.yeib_banner_text') }}</span>
            </div>
            <span class="hidden sm:inline opacity-30">—</span>
            <span class="bg-brand-500 text-white px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest animate-pulse">{{ __('messages.learn_more') }}</span>
        </a>
    </div>

    <style>
        body { padding-bottom: 80px !important; }
        @media (max-width: 640px) {
            body { padding-bottom: 100px !important; }
        }
    </style>
</body>
</html>

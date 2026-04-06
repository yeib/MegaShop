@extends('layouts.app')

@section('content')
@php
    $view = request('view', 'grid');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center sm:items-end gap-8 mb-16">
        <div class="space-y-3 text-center sm:text-left">
            <h1 class="text-4xl sm:text-6xl font-black tracking-tighter leading-none italic text-gradient uppercase">{{ __('messages.wishlist') }}</h1>
            <p class="text-slate-500 font-medium tracking-wide text-sm sm:text-lg max-w-xl">{{ __('Guarda los productos que más te gustan para comprarlos después.') }}</p>
        </div>
        
        <div class="flex items-center gap-6">
            <!-- View Toggle -->
            <div class="flex bg-slate-100 dark:bg-slate-900 p-1 rounded-xl sm:rounded-2xl border border-slate-200/50 dark:border-slate-800/50 shadow-inner">
                <a href="{{ route('wishlist.index', ['view' => 'grid']) }}" 
                   class="p-2 sm:p-3 rounded-lg sm:rounded-xl transition-all duration-300 {{ $view == 'grid' ? 'bg-white dark:bg-slate-800 text-brand-600 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                </a>
                <a href="{{ route('wishlist.index', ['view' => 'list']) }}" 
                   class="p-2 sm:p-3 rounded-lg sm:rounded-xl transition-all duration-300 {{ $view == 'list' ? 'bg-white dark:bg-slate-800 text-brand-600 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </a>
            </div>

            <div class="hidden sm:flex bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 px-6 py-3 rounded-3xl shadow-xl shadow-slate-200/20 dark:shadow-none items-center gap-4">
                <div class="bg-rose-500 w-8 h-8 rounded-xl flex items-center justify-center text-white shadow-lg shadow-rose-500/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">{{ $wishlistItems->count() }} {{ __('Productos') }}</span>
            </div>
        </div>
    </div>

    @if($wishlistItems->count() > 0)
        @if($view == 'grid')
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
                @foreach($wishlistItems as $product)
                    <div class="group relative bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-64 sm:h-80 overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->translated_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm">{{ $product->category->translated_name }}</span>
                            </div>

                            <!-- Remove Button -->
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="absolute top-6 right-6 z-10">
                                @csrf
                                <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-full bg-rose-500 text-white transition-all shadow-xl shadow-rose-500/40 hover:scale-110 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </form>
                        </div>
                        <div class="p-8 sm:p-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-1 text-amber-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-[10px] font-black text-slate-400">{{ $product->average_rating }}</span>
                                </div>
                                @if($product->discount > 0)
                                    <span class="text-rose-500 font-black text-[10px] uppercase tracking-widest animate-pulse">-{{ $product->discount }}% OFF</span>
                                @endif
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black tracking-tight mb-8 group-hover:text-brand-600 transition-colors truncate">{{ $product->translated_name }}</h3>
                            <div class="flex items-center justify-between gap-4 border-t border-slate-50 dark:border-slate-800 pt-6 sm:pt-8">
                                <div class="flex flex-col">
                                    @if($product->discount > 0)
                                        <span class="text-[10px] sm:text-xs text-slate-400 font-bold line-through mb-1">${{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">${{ number_format($product->final_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">${{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('cart.add', $product) }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-xl shadow-brand-500/30 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95 group/cart">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-transform group-hover/cart:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Vista de Lista (Igual que Home) -->
            <div class="space-y-4 md:space-y-10">
                @foreach($wishlistItems as $product)
                    <div class="group flex flex-row bg-white dark:bg-slate-900 rounded-[1.2rem] sm:rounded-[3rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden hover:shadow-xl transition-all duration-500 cursor-pointer h-32 sm:h-auto relative">
                        <div class="w-32 sm:w-72 lg:w-96 shrink-0 overflow-hidden relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->translated_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            @if($product->discount > 0)
                                <div class="absolute top-2 left-2 sm:top-6 sm:left-6 bg-rose-500 text-white px-2 py-0.5 sm:px-4 sm:py-1.5 rounded-lg text-[7px] sm:text-[10px] font-black uppercase tracking-widest shadow-2xl">-{{ $product->discount }}%</div>
                            @endif
                        </div>
                        <div class="p-4 sm:p-12 flex-grow flex flex-col justify-center min-w-0">
                            <div class="flex items-center justify-between mb-1 sm:mb-2">
                                <span class="text-[7px] sm:text-[10px] font-black uppercase tracking-[0.2em] text-brand-600 truncate">{{ $product->category->translated_name }}</span>
                                <div class="flex items-center gap-1 text-amber-400 shrink-0">
                                    <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-[7px] sm:text-[10px] font-black text-slate-400">{{ $product->average_rating }}</span>
                                </div>
                            </div>
                            <h3 class="text-sm sm:text-3xl font-black tracking-tight mb-1 sm:mb-4 group-hover:text-brand-600 transition-colors truncate">{{ $product->translated_name }}</h3>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-2 sm:gap-4">
                                    <span class="text-base sm:text-4xl font-black text-slate-900 dark:text-white">${{ number_format($product->final_price, 0, ',', '.') }}</span>
                                    @if($product->discount > 0)
                                        <span class="text-[10px] sm:text-xl text-slate-300 font-bold line-through">${{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-8 h-8 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-6 sm:w-6 fill-current" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('cart.add', $product) }}" class="w-8 h-8 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-lg shadow-brand-500/30 hover:bg-brand-700 transition-all shrink-0">
                                        <svg class="w-4 h-4 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <div class="text-center py-40 bg-white dark:bg-slate-900 rounded-[4rem] border border-slate-100 dark:border-slate-800 shadow-inner">
            <div class="bg-rose-500/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-10 text-rose-500 shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
            </div>
            <p class="text-slate-400 font-black uppercase tracking-[0.4em] mb-10 text-sm">{{ __('Tu lista está vacía') }}</p>
            <a href="{{ route('home') }}" class="inline-block bg-brand-600 text-white px-12 py-5 rounded-3xl font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-brand-500/40 hover:bg-brand-700 transition-all hover:-translate-y-1 active:scale-95">
                {{ __('Descubrir Productos') }}
            </a>
        </div>
    @endif
</div>
@endsection

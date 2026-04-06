@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
        <h1 class="text-4xl sm:text-5xl font-black tracking-tighter italic text-gradient">{{ __('messages.cart') }}</h1>
        <a href="{{ route('home') }}" class="group flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-brand-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
            {{ __('messages.continue_shopping') }}
        </a>
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
            <div class="lg:col-span-2 space-y-6">
                @foreach($cart as $id => $details)
                    <div class="group relative flex flex-col sm:flex-row items-center gap-6 bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-500">
                        <div class="w-24 h-24 sm:w-32 sm:h-32 shrink-0 overflow-hidden rounded-2xl bg-slate-100 dark:bg-slate-800">
                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        </div>
                        <div class="flex-grow text-center sm:text-left">
                            <h3 class="text-xl font-black tracking-tight mb-1">{{ $details['name'] }}</h3>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-4 mt-2">
                                <span class="text-xs font-black uppercase tracking-widest text-slate-400">
                                    ${{ number_format($details['price'], 0, ',', '.') }} x {{ $details['quantity'] }}
                                </span>
                                <div class="flex bg-slate-100 dark:bg-slate-800 rounded-lg p-1">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                        <button type="submit" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-brand-500 transition-colors">-</button>
                                    </form>
                                    <span class="px-2 text-xs font-black">{{ $details['quantity'] }}</span>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                        <button type="submit" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-brand-500 transition-colors">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center sm:text-right shrink-0">
                            <p class="text-2xl font-black text-slate-900 dark:text-white">${{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-rose-500 hover:text-rose-600 transition-colors">{{ __('messages.remove') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:sticky lg:top-32 h-fit">
                <div class="bg-slate-900 dark:bg-brand-900 text-white p-10 rounded-[3rem] shadow-2xl shadow-brand-500/20 relative overflow-hidden">
                    <!-- Decoración interna -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-500 rounded-full blur-[60px] opacity-20"></div>
                    
                    <h2 class="text-xs font-black uppercase tracking-[0.3em] text-brand-400 mb-8">{{ __('messages.summary') }}</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                            <span>{{ __('messages.shipping') }}</span>
                            <span class="text-emerald-400 font-black uppercase text-[10px] tracking-widest">{{ __('messages.free') }}</span>
                        </div>
                        <div class="border-t border-white/10 pt-6 flex justify-between items-end">
                            <span class="text-xs font-black uppercase tracking-widest text-brand-400">Total</span>
                            <span class="text-4xl font-black">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-brand-500 text-white text-center py-6 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-brand-500/40 hover:bg-brand-600 hover:-translate-y-1 transition-all active:scale-95">
                        {{ __('messages.checkout') }}
                    </a>
                </div>
                
                <div class="mt-8 flex items-center justify-center gap-4 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ __('messages.secure_checkout') }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-24 bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-inner">
            <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <p class="text-slate-400 text-lg font-medium mb-8">{{ __('messages.empty_cart') }}</p>
            <a href="{{ route('home') }}" class="inline-block bg-brand-500 text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-brand-600 transition-all shadow-xl shadow-brand-500/20">{{ __('messages.home') }}</a>
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-12 px-4">
    <div class="bg-white dark:bg-slate-900 p-8 sm:p-12 rounded-[3rem] shadow-2xl border border-slate-100 dark:border-slate-800 relative overflow-hidden text-center">
        <!-- Decoración -->
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-brand-500 rounded-full blur-[60px] opacity-10"></div>
        
        <h1 class="text-3xl sm:text-4xl font-black mb-4 italic text-gradient tracking-tighter shrink-0">Mega Shop</h1>
        <p class="text-slate-500 dark:text-slate-400 mb-10 font-medium">{{ __('Este es un checkout simulado para fines de demostración.') }}</p>
        
        <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-[2rem] mb-10 border border-slate-100 dark:border-slate-800/50">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 block mb-2">{{ __('Total a pagar') }}</span>
            <div class="text-4xl sm:text-5xl font-black text-slate-900 dark:text-white">
                ${{ number_format($total, 0, ',', '.') }}
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-brand-600 text-white py-6 rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-xl shadow-brand-500/40 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95">
                {{ __('ACEPTAR Y PAGAR') }}
            </button>
        </form>
        
        <div class="mt-8 flex items-center justify-center gap-3 text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <span class="text-[9px] font-black uppercase tracking-widest">{{ __('Pago encriptado y seguro') }}</span>
        </div>
    </div>
</div>
@endsection

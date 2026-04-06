@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6">
        <div class="space-y-2">
            <h1 class="text-5xl font-black tracking-tight leading-none italic uppercase text-gradient">{{ __('Centro de Soporte') }}</h1>
            <p class="text-slate-500 font-medium tracking-wide">{{ __('Gestiona tus consultas y reclamos sobre tus pedidos.') }}</p>
        </div>
    </div>

    @if($tickets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($tickets as $ticket)
                <a href="{{ route('tickets.show', $ticket) }}" class="group block bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-200/50 dark:border-slate-800/50 hover:border-brand-500/50 transition-all hover:shadow-2xl">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] px-4 py-1.5 rounded-full {{ $ticket->status == 'resolved' ? 'bg-emerald-500/10 text-emerald-500' : ($ticket->status == 'closed' ? 'bg-slate-500/10 text-slate-500' : 'bg-amber-500/10 text-amber-500') }}">
                                {{ $ticket->status }}
                            </span>
                            <h3 class="text-xl font-extrabold mt-4 group-hover:text-brand-600 transition-colors">{{ $ticket->subject }}</h3>
                        </div>
                        <p class="text-[10px] font-black text-slate-400">{{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                    
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 mb-6">{{ $ticket->message }}</p>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50 dark:border-slate-800">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                            {{ $ticket->order_id ? 'Orden #' . $ticket->order_id : 'Consulta General' }}
                        </span>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-brand-500 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-40 bg-white/50 dark:bg-brand-900/5 rounded-[4rem] border-2 border-dashed border-brand-500/10 dark:border-brand-500/20">
            <div class="bg-brand-500/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-10 text-brand-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
            </div>
            <p class="text-slate-400 font-black uppercase tracking-[0.4em] mb-10">{{ __('No tienes tickets activos') }}</p>
            <p class="text-slate-400 text-sm mb-10 max-w-md mx-auto">{{ __('Puedes crear un ticket desde tu historial de compras si tienes algún problema con un pedido.') }}</p>
            <a href="{{ route('orders.index') }}" class="inline-block bg-brand-600 text-white px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-brand-500/40 hover:bg-brand-700 transition-all hover:-translate-y-1">
                {{ __('Ver mis compras') }}
            </a>
        </div>
    @endif
</div>
@endsection

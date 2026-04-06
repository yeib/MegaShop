@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-12">
    <a href="{{ route('tickets.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
        {{ __('Volver a mis tickets') }}
    </a>

    <div class="bg-white dark:bg-slate-900 rounded-[3rem] overflow-hidden border border-brand-500/10 dark:border-brand-500/20 shadow-2xl">
        <div class="p-12 space-y-8">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] px-4 py-1.5 rounded-full {{ $ticket->status == 'resolved' ? 'bg-emerald-500/10 text-emerald-500' : ($ticket->status == 'closed' ? 'bg-slate-500/10 text-slate-500' : 'bg-amber-500/10 text-amber-500') }}">
                        {{ $ticket->status }}
                    </span>
                    <h1 class="text-4xl font-black tracking-tighter">{{ $ticket->subject }}</h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $ticket->created_at->format('d M, Y H:i') }} | {{ $ticket->order_id ? 'Orden #' . $ticket->order_id : 'Consulta General' }}</p>
                </div>
            </div>

            <div class="p-8 bg-slate-50 dark:bg-slate-950 rounded-[2rem] border border-slate-100 dark:border-slate-800">
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $ticket->message }}</p>
            </div>

            @if($ticket->admin_response)
                <div class="space-y-6 pt-8 border-t border-slate-100 dark:border-slate-800">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-brand-600 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h10a8 8 0 018 8v2M3 10l5 5m-5-5l5-5"/></svg>
                        </div>
                        {{ __('Respuesta del Administrador') }}
                    </h3>
                    <div class="p-8 bg-brand-500/5 dark:bg-brand-500/10 rounded-[2.5rem] border border-brand-500/10">
                        <p class="text-slate-700 dark:text-slate-200 leading-relaxed">{{ $ticket->admin_response }}</p>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-4 p-8 bg-amber-500/5 rounded-3xl border border-amber-500/10">
                    <div class="w-10 h-10 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center animate-pulse">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-bold text-amber-600 uppercase tracking-widest">{{ __('Estamos revisando tu caso. Pronto recibirás una respuesta.') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

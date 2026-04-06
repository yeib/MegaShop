@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-12">
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            {{ __('Volver a la lista') }}
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[3rem] overflow-hidden border border-brand-500/10 dark:border-brand-500/20 shadow-2xl">
        <div class="p-12 space-y-10">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] px-4 py-1.5 rounded-full {{ $ticket->status == 'resolved' ? 'bg-emerald-500/10 text-emerald-500' : ($ticket->status == 'closed' ? 'bg-slate-500/10 text-slate-500' : 'bg-amber-500/10 text-amber-500') }}">
                            {{ $ticket->status }}
                        </span>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Ticket del Usuario') }}</p>
                    </div>
                    <h1 class="text-4xl font-black tracking-tighter">{{ $ticket->subject }}</h1>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-extrabold text-slate-800 dark:text-slate-200">{{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $ticket->created_at->format('d M, Y H:i') }} | {{ $ticket->order_id ? 'Orden #' . $ticket->order_id : 'Consulta General' }}</p>
                    </div>
                </div>
            </div>

            <div class="p-10 bg-slate-50 dark:bg-slate-950 rounded-[2.5rem] border border-slate-100 dark:border-slate-800">
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed italic">"{{ $ticket->message }}"</p>
            </div>

            <div class="pt-10 border-t border-slate-100 dark:border-slate-800">
                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-brand-600 mb-8 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h10a8 8 0 018 8v2M3 10l5 5m-5-5l5-5"/></svg>
                    </div>
                    {{ __('Gestionar Respuesta') }}
                </h3>

                <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">{{ __('Estado del Ticket') }}</label>
                            <select name="status" class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl px-6 py-4 font-black uppercase text-xs tracking-widest focus:ring-2 focus:ring-brand-500">
                                <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">{{ __('Respuesta al Usuario') }}</label>
                        <textarea name="admin_response" rows="6" placeholder="{{ __('Escribe aquí tu respuesta...') }}" class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-[2rem] px-8 py-6 font-bold focus:ring-2 focus:ring-brand-500">{{ $ticket->admin_response }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-brand-600 text-white px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-brand-500/40 hover:bg-brand-700 hover:-translate-y-1 transition-all">
                            {{ __('Guardar y Notificar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

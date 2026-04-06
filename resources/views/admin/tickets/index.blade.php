@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-black italic tracking-tighter">{{ __('GESTIÓN DE TICKETS') }}</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-600 transition-colors">
            {{ __('Volver al Panel') }}
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[3rem] overflow-hidden border border-brand-500/10 dark:border-brand-500/20 shadow-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-brand-900/10 border-b border-brand-500/10">
                    <th class="p-8 text-[10px] font-black uppercase tracking-widest text-slate-400">Usuario</th>
                    <th class="p-8 text-[10px] font-black uppercase tracking-widest text-slate-400">Asunto</th>
                    <th class="p-8 text-[10px] font-black uppercase tracking-widest text-slate-400">Estado</th>
                    <th class="p-8 text-[10px] font-black uppercase tracking-widest text-slate-400">Fecha</th>
                    <th class="p-8 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @foreach($tickets as $ticket)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-brand-900/5 transition-colors">
                        <td class="p-8">
                            <p class="font-bold">{{ $ticket->user->name }}</p>
                            <p class="text-[10px] text-slate-400">{{ $ticket->user->email }}</p>
                        </td>
                        <td class="p-8">
                            <p class="font-bold">{{ $ticket->subject }}</p>
                            <p class="text-[10px] text-slate-400">{{ $ticket->order_id ? 'Orden #' . $ticket->order_id : 'General' }}</p>
                        </td>
                        <td class="p-8">
                            <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full {{ $ticket->status == 'resolved' ? 'bg-emerald-500/10 text-emerald-500' : ($ticket->status == 'closed' ? 'bg-slate-500/10 text-slate-500' : 'bg-amber-500/10 text-amber-500') }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="p-8 text-xs font-medium text-slate-400">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="p-8 text-right">
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-brand-500 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-8 bg-slate-50/50 dark:bg-brand-900/5">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection

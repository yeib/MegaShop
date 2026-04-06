@extends('layouts.app')

@section('content')
<div x-data="{ 
    openTicketModal: false, 
    orderId: null,
    openModal(id) {
        this.orderId = id;
        this.openTicketModal = true;
    }
}">
    <div class="flex flex-col md:flex-row justify-between items-center sm:items-end gap-8 mb-16">
        <div class="space-y-3 text-center sm:text-left">
            <h1 class="text-4xl sm:text-6xl font-black tracking-tighter leading-none italic text-gradient uppercase">{{ __('messages.orders') }}</h1>
            <p class="text-slate-500 font-medium tracking-wide text-sm sm:text-lg max-w-xl">{{ __('Revisa el historial de tus compras y reporta cualquier problema.') }}</p>
        </div>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-10">
            @foreach($orders as $order)
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-xl shadow-slate-200/20 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-8 sm:p-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 bg-slate-50/50 dark:bg-brand-900/10 border-b border-slate-50 dark:border-slate-800">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-2">Orden #{{ $order->id }}</p>
                            <p class="text-lg font-black text-slate-900 dark:text-white">{{ $order->created_at->format('d M, Y') }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-6">
                            <div class="text-left sm:text-right">
                                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-1">Total</p>
                                <p class="text-3xl font-black text-brand-600">${{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                            <button @click="openModal({{ $order->id }})" class="bg-white dark:bg-slate-800 border border-brand-500/20 text-brand-600 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-500 hover:text-white transition-all shadow-sm">
                                {{ __('Reportar Problema') }}
                            </button>
                        </div>
                    </div>
                    <div class="p-8 sm:p-10">
                        <ul class="divide-y divide-slate-50 dark:divide-slate-800">
                            @foreach($order->items as $item)
                                <li class="py-6 flex justify-between items-center group/item">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden shadow-inner bg-slate-50 dark:bg-slate-800">
                                            <img src="{{ $item->product->image_url }}" class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-500">
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-800 dark:text-slate-100 text-base sm:text-xl">{{ $item->product->translated_name }}</p>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">{{ $item->quantity }} x ${{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <p class="font-black text-slate-900 dark:text-white text-lg sm:text-2xl">${{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-40 bg-white dark:bg-slate-900 rounded-[4rem] border border-slate-100 dark:border-slate-800 shadow-inner">
            <div class="bg-brand-500/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-10 text-brand-500 shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <p class="text-slate-400 font-black uppercase tracking-[0.4em] mb-10 text-sm">{{ __('Aún no tienes órdenes') }}</p>
            <a href="{{ route('home') }}" class="inline-block bg-brand-600 text-white px-12 py-5 rounded-3xl font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-brand-500/40 hover:bg-brand-700 transition-all hover:-translate-y-1 active:scale-95">
                {{ __('Explorar Productos') }}
            </a>
        </div>
    @endif

    <!-- TICKET MODAL -->
    <template x-teleport="body">
        <div x-show="openTicketModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xl" x-cloak>
            <div class="bg-white dark:bg-slate-950 w-full max-w-xl rounded-[3.5rem] overflow-hidden shadow-2xl border border-white/10" @click.away="openTicketModal = false">
                <div class="p-10 sm:p-16">
                    <h2 class="text-4xl font-black tracking-tighter mb-2 italic text-gradient">{{ __('Reportar un Problema') }}</h2>
                    <p class="text-slate-400 text-[10px] font-black mb-10 uppercase tracking-[0.3em]">Orden #<span x-text="orderId"></span></p>
                    
                    <form action="{{ route('tickets.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="order_id" :value="orderId">
                        
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">{{ __('Asunto') }}</label>
                            <input type="text" name="subject" required class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-[1.5rem] px-8 py-5 font-bold focus:ring-2 focus:ring-brand-500 transition-all" placeholder="Ej: No recibí el producto">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">{{ __('Mensaje Detallado') }}</label>
                            <textarea name="message" rows="4" required class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-[1.5rem] px-8 py-5 font-bold focus:ring-2 focus:ring-brand-500 transition-all" placeholder="Describe el problema con el mayor detalle posible..."></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="button" @click="openTicketModal = false" class="flex-1 px-8 py-5 rounded-2xl font-black uppercase text-xs tracking-widest text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                                {{ __('Cancelar') }}
                            </button>
                            <button type="submit" class="flex-1 bg-brand-600 text-white px-8 py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-brand-500/40 hover:bg-brand-700 transition-all hover:-translate-y-1">
                                {{ __('Enviar Reporte') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

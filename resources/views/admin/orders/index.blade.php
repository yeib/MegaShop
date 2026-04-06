@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-black mb-10 italic uppercase">{{ __('Historial Global de Ventas') }}</h1>

<div class="space-y-6">
    @foreach($orders as $order)
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden shadow-sm">
            <div class="p-8 flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-50 dark:bg-slate-800/50 gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-brand-600 text-white flex items-center justify-center rounded-2xl font-black text-xl shadow-lg shadow-brand-500/20 italic">#{{ $order->id }}</div>
                    <div>
                        <p class="text-xs font-black uppercase text-slate-400 tracking-widest">Cliente</p>
                        <p class="font-bold text-lg leading-tight">{{ $order->user->name }} <span class="text-slate-400 font-normal text-xs italic">({{ $order->user->email }})</span></p>
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-xs font-black uppercase text-slate-400 tracking-widest">Fecha y Hora</p>
                    <p class="font-bold">{{ $order->created_at->format('d/m/Y - H:i') }}</p>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-xs font-black uppercase text-slate-400 tracking-widest">Monto</p>
                    <p class="text-2xl font-black text-brand-600">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800">
                            <img src="{{ $item->product->image_url }}" class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <p class="text-sm font-bold">{{ $item->product->translated_name }}</p>
                                <p class="text-[10px] font-black uppercase text-slate-400">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="mb-12 flex justify-between items-center">
    <h1 class="text-4xl font-black italic tracking-tighter">ADMIN PANEL</h1>
    <div class="flex gap-4">
        <a href="{{ route('admin.products') }}" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold uppercase text-xs">{{ __('Gestionar Productos') }}</a>
        <a href="{{ route('admin.orders') }}" class="px-6 py-3 bg-brand-600 text-white rounded-2xl font-bold uppercase text-xs">{{ __('Ventas') }}</a>
        <a href="{{ route('admin.tickets.index') }}" class="px-6 py-3 bg-rose-500 text-white rounded-2xl font-bold uppercase text-xs transition-all hover:bg-rose-600 shadow-lg shadow-rose-500/20">{{ __('Tickets') }}</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-5 gap-8">
    <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 shadow-sm">
        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Ventas Totales</p>
        <p class="text-3xl font-black">${{ number_format($stats['total_sales'], 2) }}</p>
    </div>
    <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 shadow-sm">
        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Órdenes</p>
        <p class="text-3xl font-black">{{ $stats['orders_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 shadow-sm">
        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Productos</p>
        <p class="text-3xl font-black">{{ $stats['products_count'] }}</p>
    </div>
    <div class="bg-amber-50 dark:bg-amber-900/20 p-8 rounded-[2rem] border border-amber-100 dark:border-amber-800/50 shadow-sm">
        <p class="text-[10px] font-black uppercase tracking-widest text-amber-500 mb-2">Stock Bajo</p>
        <p class="text-3xl font-black text-amber-600">{{ $stats['low_stock'] }}</p>
    </div>
    <div class="bg-rose-50 dark:bg-rose-900/20 p-8 rounded-[2rem] border border-rose-100 dark:border-rose-800/50 shadow-sm">
        <p class="text-[10px] font-black uppercase tracking-widest text-rose-500 mb-2">Tickets Pendientes</p>
        <p class="text-3xl font-black text-rose-600">{{ \App\Models\Ticket::where('status', 'pending')->count() }}</p>
    </div>
</div>
@endsection

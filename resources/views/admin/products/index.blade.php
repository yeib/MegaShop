@extends('layouts.app')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <h1 class="text-3xl font-black">{{ __('Gestionar Productos') }}</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-brand-600 text-white px-6 py-3 rounded-2xl font-bold uppercase text-xs shadow-lg shadow-brand-500/20 hover:scale-105 transition-all">
        {{ __('+ Nuevo Producto') }}
    </a>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 dark:bg-slate-800">
            <tr>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Producto</th>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Estado</th>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Precio</th>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Desc. %</th>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Stock</th>
                <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
            @foreach($products as $product)
                <tr>
                    <td class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ $product->image_url }}" class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <p class="font-bold">{{ $product->translated_name }}</p>
                                <p class="text-xs text-slate-400 uppercase font-black tracking-widest">{{ $product->category->translated_name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6">
                        <div class="flex flex-col gap-2">
                            <form action="{{ route('admin.products.toggle-pause', $product) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest transition-all {{ $product->is_paused ? 'bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white' : 'bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white' }}">
                                    {{ $product->is_paused ? 'Pausado' : 'Publicado' }}
                                </button>
                            </form>
                            @if($product->reports_count > 0)
                                <div class="flex items-center gap-1.5 text-rose-500">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                    <span class="text-[9px] font-black">{{ $product->reports_count }} reportes</span>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="p-6 font-bold text-slate-600 dark:text-slate-300">${{ number_format($product->price, 2) }}</td>
                    <td class="p-6">
                        <form action="{{ route('admin.products.discount', $product) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="discount" onchange="this.form.submit()" class="bg-slate-100 dark:bg-slate-800 border-none rounded-xl p-2 font-bold text-xs">
                                <option value="0" {{ $product->discount == 0 ? 'selected' : '' }}>0%</option>
                                <option value="10" {{ $product->discount == 10 ? 'selected' : '' }}>10%</option>
                                <option value="20" {{ $product->discount == 20 ? 'selected' : '' }}>20%</option>
                                <option value="30" {{ $product->discount == 30 ? 'selected' : '' }}>30%</option>
                                <option value="40" {{ $product->discount == 40 ? 'selected' : '' }}>40%</option>
                                <option value="50" {{ $product->discount == 50 ? 'selected' : '' }}>50%</option>
                            </select>
                        </form>
                    </td>
                    <td class="p-6">
                        <form action="{{ route('admin.products.stock', $product) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="stock" value="{{ $product->stock }}" class="w-20 bg-slate-100 dark:bg-slate-800 border-none rounded-xl p-2 font-bold text-center">
                            <button type="submit" class="p-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>
                    </td>
                    <td class="p-6 text-right">
                        <form action="{{ route('admin.products.delete', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

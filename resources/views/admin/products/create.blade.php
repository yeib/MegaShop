@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-black mb-10 italic uppercase">{{ __('Nuevo Producto') }}</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white dark:bg-slate-900 p-10 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 shadow-sm">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Nombre (EN)</label>
                <input type="text" name="name_en" required class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Nombre (ES)</label>
                <input type="text" name="name_es" required class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Categoría</label>
                <select name="category_id" required class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->translated_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Precio ($)</label>
                <input type="number" step="0.01" name="price" required class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Stock Inicial</label>
                <input type="number" name="stock" required class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">URL Imagen (opcional)</label>
                <input type="text" name="image_url" placeholder="https://..." class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-4 font-bold">
            </div>
        </div>

        <div class="md:col-span-2 text-right mt-6">
            <a href="{{ route('admin.products') }}" class="px-8 py-4 font-black uppercase text-xs text-slate-400 hover:text-slate-600 mr-4">{{ __('Cancelar') }}</a>
            <button type="submit" class="px-10 py-5 bg-brand-600 text-white rounded-3xl font-black uppercase text-xs shadow-xl shadow-brand-500/20 hover:scale-105 transition-all">
                {{ __('Guardar Producto') }}
            </button>
        </div>
    </form>
</div>
@endsection

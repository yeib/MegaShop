@extends('layouts.app')

@section('content')
<div x-data="{ 
    openModal: false, 
    editMode: false,
    catId: null,
    nameEn: '',
    nameEs: '',
    openCreate() {
        this.editMode = false;
        this.nameEn = '';
        this.nameEs = '';
        this.openModal = true;
    },
    openEdit(cat) {
        this.editMode = true;
        this.catId = cat.id;
        this.nameEn = cat.name.en;
        this.nameEs = cat.name.es;
        this.openModal = true;
    }
}">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-black italic tracking-tighter text-gradient uppercase">Gestión de Categorías</h1>
        <button @click="openCreate()" class="bg-brand-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-brand-500/20 hover:bg-brand-700 transition-all hover:-translate-y-1">
            + Nueva Categoría
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($categories as $category)
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-brand-500/10 shadow-sm hover:shadow-2xl transition-all group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-brand-500/10 flex items-center justify-center text-brand-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button @click="openEdit({{ json_encode($category) }})" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form action="{{ route('admin.categories.delete', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <h3 class="text-xl font-black mb-2">{{ $category->name['es'] }}</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $category->name['en'] }}</p>
                <div class="mt-6 pt-6 border-t border-slate-50 dark:border-slate-800 flex justify-between items-center">
                    <span class="text-[10px] font-black uppercase text-slate-400">{{ $category->products()->count() }} Productos</span>
                    <span class="text-[10px] font-black uppercase text-brand-500">/{{ $category->slug }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- MODAL -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xl" x-cloak>
            <div class="bg-white dark:bg-slate-950 w-full max-w-lg rounded-[3rem] overflow-hidden shadow-2xl border border-white/10">
                <div class="p-12">
                    <h2 class="text-3xl font-black tracking-tighter mb-8 italic text-gradient" x-text="editMode ? 'Editar Categoría' : 'Nueva Categoría'"></h2>
                    
                    <form :action="editMode ? '/admin/categories/' + catId : '{{ route('admin.categories.store') }}'" method="POST" class="space-y-6">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PATCH">
                        </template>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Nombre (Español)</label>
                            <input type="text" name="name_es" x-model="nameEs" required class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-brand-500">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Name (English)</label>
                            <input type="text" name="name_en" x-model="nameEn" required class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-brand-500">
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="openModal = false" class="flex-1 px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                                Cancelar
                            </button>
                            <button type="submit" class="flex-1 bg-brand-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-brand-500/20 hover:bg-brand-700 transition-all">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

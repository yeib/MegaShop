@extends('layouts.app')

@section('content')
<div x-data="{ 
    openModal: false, 
    product: {},
    showProduct(p) {
        this.product = p;
        this.openModal = true;
    }
}" 
x-init="$watch('openModal', value => {
    document.body.style.overflow = value ? 'hidden' : '';
})"
class="relative">

    <div class="flex flex-col md:flex-row gap-8 lg:gap-16">
        <!-- Sidebar Responsivo -->
        <aside class="w-full md:w-64">
            <div class="md:sticky md:top-32">
                <h2 class="hidden md:block text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-8 border-l-2 border-brand-500 pl-4">{{ __('messages.categories') }}</h2>
                <ul class="flex md:flex-col gap-2 overflow-x-auto md:overflow-visible pb-4 md:pb-0 scrollbar-hide -mx-4 px-4 md:mx-0 md:px-0">
                    <li class="shrink-0 md:shrink">
                        <a href="{{ route('home') }}" class="group flex items-center justify-between px-5 py-3 md:py-4 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold transition-all duration-300 {{ !request('category') ? 'bg-brand-600 text-white shadow-xl shadow-brand-500/20 md:translate-x-2' : 'text-slate-500 hover:bg-white dark:hover:bg-slate-900 hover:text-brand-600 bg-white/50 dark:bg-slate-900/50' }}">
                            <span>{{ __('messages.home') }}</span>
                        </a>
                    </li>
                    <li class="shrink-0 md:shrink">
                        <a href="{{ route('home', ['category' => 'offers']) }}" class="group flex items-center gap-3 px-5 py-3 md:py-4 rounded-xl md:rounded-2xl text-xs md:text-sm font-black transition-all duration-300 {{ request('category') == 'offers' ? 'bg-rose-500 text-white shadow-xl shadow-rose-500/20 md:translate-x-2' : 'text-rose-500 hover:bg-rose-50 bg-white/50 dark:bg-slate-900/50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.927-1.355-1.34a8.384 8.384 0 01-1.2-1.607 1 1 0 00-.4-.55z" clip-rule="evenodd" /></svg>
                            <span>{{ __('messages.offers') }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="shrink-0 md:shrink">
                            <a href="{{ route('home', ['category' => $category->slug]) }}" 
                               class="group flex items-center justify-between px-5 py-3 md:py-4 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold transition-all duration-300 {{ request('category') == $category->slug ? 'bg-brand-600 text-white shadow-xl shadow-brand-500/20 md:translate-x-2' : 'text-slate-500 hover:bg-white dark:hover:bg-slate-900 hover:text-brand-600 bg-white/50 dark:bg-slate-900/50' }}">
                                <span>{{ $category->translated_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Section -->
        <section class="flex-grow min-w-0">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-6 mb-10 md:mb-16">
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-none">{{ __('messages.premium_selection') }}</h1>
                    <p class="text-sm sm:text-base text-slate-500 font-medium tracking-wide">Descubre el equilibrio perfecto entre diseño y utilidad.</p>
                </div>
                
                <div class="flex bg-slate-100 dark:bg-slate-900 p-1 rounded-xl sm:rounded-2xl border border-slate-200/50 dark:border-slate-800/50 shadow-inner">
                    <a href="{{ route('home', ['view' => 'grid', 'category' => request('category')]) }}" 
                       class="p-2 sm:p-3 rounded-lg sm:rounded-xl transition-all duration-300 {{ $view == 'grid' ? 'bg-white dark:bg-slate-800 text-brand-600 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                    </a>
                    <a href="{{ route('home', ['view' => 'list', 'category' => request('category')]) }}" 
                       class="p-2 sm:p-3 rounded-lg sm:rounded-xl transition-all duration-300 {{ $view == 'list' ? 'bg-white dark:bg-slate-800 text-brand-600 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </a>
                </div>
            </div>

            <!-- SECCIÓN VIP -->
            @if($vip_products->count() > 0 && !request('category'))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 mb-16 md:mb-20">
                    @foreach($vip_products as $product)
                        <div 
                            @click="showProduct({
                                id: {{ $product->id }},
                                name: '{{ $product->translated_name }}',
                                desc: '{{ $product->translated_description }}',
                                price: '{{ number_format($product->price, 0, ',', '.') }}',
                                final_price: '{{ number_format($product->final_price, 0, ',', '.') }}',
                                discount: {{ $product->discount }},
                                stock: {{ $product->stock }},
                                rating: {{ $product->average_rating }},
                                image: '{{ $product->image_url }}',
                                category: '{{ $product->category->translated_name }}',
                                add_url: '{{ route('cart.add', $product) }}',
                                reviews: {{ $product->reviews->map(fn($r) => ['user' => $r->user->name, 'rating' => $r->rating, 'comment' => $r->comment, 'date' => $r->created_at->format('d/m/Y')])->toJson() }}
                            })"
                            class="group relative bg-brand-900 rounded-[2rem] sm:rounded-[3rem] overflow-hidden shadow-2xl transition-all duration-700 hover:-translate-y-2 cursor-pointer h-72 sm:h-96">
                            <img src="{{ $product->image_url }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-[2s]">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/20 to-transparent"></div>
                            <div class="absolute inset-0 p-6 sm:p-12 flex flex-col justify-end">
                                <span class="bg-brand-500 text-white w-fit px-3 py-1 rounded-full text-[8px] sm:text-[10px] font-black uppercase tracking-widest mb-2 sm:mb-4">{{ __('messages.exclusive_vip') }}</span>
                                <h3 class="text-xl sm:text-3xl font-black text-white mb-1 sm:mb-2">{{ $product->translated_name }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl sm:text-2xl font-black text-brand-100">${{ number_format($product->final_price, 0, ',', '.') }}</span>
                                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-white text-brand-900 flex items-center justify-center shadow-2xl shrink-0">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h2 class="text-[8px] sm:text-[10px] font-black uppercase tracking-[0.5em] text-slate-300 mb-8 md:mb-10 text-center">— {{ __('messages.regular_collection') }} —</h2>
            @endif

            @if($view == 'grid')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-10">
                    @foreach($products as $product)
                        <div 
                            @click="showProduct({
                                id: {{ $product->id }},
                                name: '{{ $product->translated_name }}',
                                desc: '{{ $product->translated_description }}',
                                price: '{{ number_format($product->price, 0, ',', '.') }}',
                                final_price: '{{ number_format($product->final_price, 0, ',', '.') }}',
                                discount: {{ $product->discount }},
                                stock: {{ $product->stock }},
                                rating: {{ $product->average_rating }},
                                image: '{{ $product->image_url }}',
                                category: '{{ $product->category->translated_name }}',
                                add_url: '{{ route('cart.add', $product) }}',
                                reviews: {{ $product->reviews->map(fn($r) => ['user' => $r->user->name, 'rating' => $r->rating, 'comment' => $r->comment, 'date' => $r->created_at->format('d/m/Y')])->toJson() }}
                            })"
                            class="group relative bg-white dark:bg-slate-900 rounded-[1.5rem] sm:rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden hover:shadow-xl dark:hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 cursor-pointer">
                            <div class="relative h-48 sm:h-64 lg:h-72 overflow-hidden">
                                <img src="{{ $product->image_url }}" alt="{{ $product->translated_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="absolute top-4 left-4 sm:top-6 sm:left-6 flex flex-col gap-2">
                                    <span class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[8px] sm:text-[10px] font-black uppercase tracking-widest shadow-sm">{{ $product->category->translated_name }}</span>
                                    @if($product->discount > 0)
                                        <span class="bg-rose-500 text-white px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[8px] sm:text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-500/40">-{{ $product->discount }}% OFF</span>
                                    @endif
                                </div>
                                @auth
                                <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="absolute top-4 right-4 sm:top-6 sm:right-6 z-10" @click.stop>
                                    @csrf
                                    <button type="submit" class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-slate-400 hover:text-rose-500 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 {{ Auth::user()->wishlists()->where('product_id', $product->id)->exists() ? 'fill-rose-500 text-rose-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                    </button>
                                </form>
                                @endauth
                            </div>
                            <div class="p-6 sm:p-10">
                                <div class="flex items-center justify-between mb-2 sm:mb-3">
                                    <h3 class="text-base sm:text-xl font-extrabold tracking-tight group-hover:text-brand-600 transition-colors duration-300 truncate mr-2">{{ $product->translated_name }}</h3>
                                    <div class="flex items-center gap-1 text-amber-400 shrink-0">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-[8px] sm:text-[10px] font-black text-slate-400 tracking-tighter">{{ $product->average_rating }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mb-4 sm:mb-6 text-[8px] sm:text-[10px] font-black uppercase tracking-widest {{ $product->stock > 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                                    <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500 animate-ping' : 'bg-rose-500' }}"></div>
                                    {{ $product->stock > 0 ? $product->stock . ' ' . __('en stock') : __('Agotado') }}
                                </div>
                                <div class="flex items-end justify-between gap-4">
                                    <div class="flex flex-col">
                                        @if($product->discount > 0)
                                            <span class="text-[10px] sm:text-xs text-slate-400 font-bold line-through mb-0.5 sm:mb-1">${{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span class="text-xl sm:text-3xl font-black text-slate-900 dark:text-white">${{ number_format($product->final_price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-xl sm:text-3xl font-black text-slate-900 dark:text-white">${{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-brand-600 transition-colors shadow-inner shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Vista de Lista -->
                <div class="space-y-4 md:space-y-10">
                    @foreach($products as $product)
                        <div 
                            @click="showProduct({
                                id: {{ $product->id }},
                                name: '{{ $product->translated_name }}',
                                desc: '{{ $product->translated_description }}',
                                price: '{{ number_format($product->price, 0, ',', '.') }}',
                                final_price: '{{ number_format($product->final_price, 0, ',', '.') }}',
                                discount: {{ $product->discount }},
                                stock: {{ $product->stock }},
                                rating: {{ $product->average_rating }},
                                image: '{{ $product->image_url }}',
                                category: '{{ $product->category->translated_name }}',
                                add_url: '{{ route('cart.add', $product) }}',
                                reviews: {{ $product->reviews->map(fn($r) => ['user' => $r->user->name, 'rating' => $r->rating, 'comment' => $r->comment, 'date' => $r->created_at->format('d/m/Y')])->toJson() }}
                            })"
                            class="group flex flex-row bg-white dark:bg-slate-900 rounded-[1.2rem] sm:rounded-[3rem] border border-slate-200/50 dark:border-slate-800/50 overflow-hidden hover:shadow-xl transition-all duration-500 cursor-pointer h-32 sm:h-auto">
                            <div class="w-32 sm:w-72 lg:w-96 shrink-0 overflow-hidden relative">
                                <img src="{{ $product->image_url }}" alt="{{ $product->translated_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                @if($product->discount > 0)
                                    <div class="absolute top-2 left-2 sm:top-6 sm:left-6 bg-rose-500 text-white px-2 py-0.5 sm:px-4 sm:py-1.5 rounded-lg text-[7px] sm:text-[10px] font-black uppercase tracking-widest shadow-2xl">-{{ $product->discount }}%</div>
                                @endif
                            </div>
                            <div class="p-4 sm:p-12 flex-grow flex flex-col justify-center min-w-0">
                                <div class="flex items-center justify-between mb-1 sm:mb-2">
                                    <span class="text-[7px] sm:text-[10px] font-black uppercase tracking-[0.2em] text-brand-600 truncate">{{ $product->category->translated_name }}</span>
                                    <div class="flex items-center gap-1 text-amber-400 shrink-0">
                                        <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-[7px] sm:text-[10px] font-black text-slate-400">{{ $product->average_rating }}</span>
                                    </div>
                                </div>
                                <h3 class="text-sm sm:text-3xl font-black tracking-tight mb-1 sm:mb-4 group-hover:text-brand-600 transition-colors truncate">{{ $product->translated_name }}</h3>
                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex items-center gap-2 sm:gap-4">
                                        <span class="text-base sm:text-4xl font-black text-slate-900 dark:text-white">${{ number_format($product->final_price, 0, ',', '.') }}</span>
                                        @if($product->discount > 0)
                                            <span class="text-[10px] sm:text-xl text-slate-300 font-bold line-through">${{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="w-8 h-8 sm:w-16 sm:h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 group-hover:text-brand-600 transition-colors shrink-0">
                                        <svg class="w-4 h-4 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>

    <!-- MODAL PREMIUM -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4 bg-slate-900/60 backdrop-blur-xl" @click.self="openModal = false" x-cloak>
            <div x-show="openModal" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-10 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="bg-white dark:bg-slate-950 w-full max-w-5xl rounded-t-[2.5rem] sm:rounded-[3rem] overflow-hidden shadow-2xl border border-white/20 relative max-h-[95vh] flex flex-col md:flex-row">
                <!-- Close Button -->
                <button @click="openModal = false" class="absolute top-6 right-6 z-50 w-10 h-10 rounded-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-md shadow-lg flex items-center justify-center hover:bg-brand-500 hover:text-white transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>

                <!-- LEFT: Image & Reviews -->
                <div class="md:w-1/2 flex flex-col bg-slate-50 dark:bg-slate-900/50">
                    <div class="h-64 sm:h-80 md:h-[400px] relative shrink-0">
                        <img :src="product.image" class="w-full h-full object-cover">
                        @auth
                        <button @click="$dispatch('open-report-modal', {id: product.id})" class="absolute bottom-6 left-6 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-4 py-2 rounded-xl text-[8px] font-black uppercase tracking-widest text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            {{ __('Reportar') }}
                        </button>
                        @endauth
                    </div>
                    
                    <div class="p-8 sm:p-10 flex-grow overflow-y-auto scrollbar-hide">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            Opiniones Reales
                        </h3>
                        <div class="space-y-4">
                            <template x-for="review in product.reviews">
                                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm transition-all hover:shadow-md">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex flex-col gap-1">
                                            <p class="text-[10px] font-black uppercase text-brand-600" x-text="review.user"></p>
                                            <div class="flex items-center text-amber-400 scale-75 origin-left">
                                                <template x-for="j in 5">
                                                    <svg class="w-3.5 h-3.5 fill-current" :class="j <= review.rating ? 'text-amber-400' : 'text-slate-200'" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                </template>
                                            </div>
                                        </div>
                                        <p class="text-[8px] font-black text-slate-400" x-text="review.date"></p>
                                    </div>
                                    <p class="text-xs text-slate-600 dark:text-slate-300 font-medium italic leading-relaxed" x-text="'&quot;' + review.comment + '&quot;'"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Details & Form -->
                <div class="md:w-1/2 p-8 sm:p-12 md:p-16 flex flex-col justify-between overflow-y-auto scrollbar-hide">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="bg-brand-500/10 text-brand-600 px-3 py-1 rounded-full text-[8px] sm:text-[10px] font-black uppercase tracking-widest" x-text="product.category"></span>
                                <template x-if="product.discount > 0">
                                    <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-[8px] sm:text-[10px] font-black uppercase tracking-widest" x-text="'-' + product.discount + '% OFF'"></span>
                                </template>
                            </div>
                            <h2 class="text-3xl sm:text-5xl font-black tracking-tighter" x-text="product.name"></h2>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center text-amber-400">
                                    <template x-for="i in 5">
                                        <svg class="w-5 h-5 fill-current" :class="i <= Math.round(product.rating) ? 'text-amber-400' : 'text-slate-200'" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </template>
                                </div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="product.rating + ' / 5'"></span>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-lg leading-relaxed" x-text="product.desc"></p>
                        </div>

                        @auth
                        <div class="bg-slate-50 dark:bg-slate-900/50 p-6 rounded-3xl border border-slate-100 dark:border-slate-800">
                            <h4 class="text-[10px] font-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Dejar una Reseña
                            </h4>
                            <form :action="'/reviews/' + product.id" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <select name="rating" class="bg-white dark:bg-slate-800 border-none rounded-xl text-[10px] font-black uppercase tracking-widest focus:ring-2 focus:ring-brand-500 shadow-sm">
                                        <option value="5">5 Estrellas</option>
                                        <option value="4">4 Estrellas</option>
                                        <option value="3">3 Estrellas</option>
                                        <option value="2">2 Estrellas</option>
                                        <option value="1">1 Estrella</option>
                                    </select>
                                    <input type="text" name="comment" placeholder="{{ __('Tu comentario...') }}" class="flex-grow bg-white dark:bg-slate-800 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-brand-500 shadow-sm">
                                    <button type="submit" class="bg-brand-600 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/20">POST</button>
                                </div>
                            </form>
                        </div>
                        @endauth
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-8">
                            <div class="flex flex-col items-center sm:items-start">
                                <template x-if="product.discount > 0">
                                    <span class="text-sm sm:text-lg text-slate-300 font-bold line-through" x-text="'$' + product.price"></span>
                                </template>
                                <span class="text-4xl sm:text-6xl font-black text-slate-900 dark:text-white" x-text="'$' + product.final_price"></span>
                            </div>
                            <template x-if="product.stock > 0">
                                <a :href="product.add_url" class="w-full sm:w-auto px-12 py-6 bg-brand-600 text-white rounded-3xl font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-brand-500/40 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95 text-center">
                                    {{ __('Añadir al Carrito') }}
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- REPORT MODAL (Always on top) -->
    <div x-data="{ openReport: false, prodId: null }" @open-report-modal.window="prodId = $event.detail.id; openReport = true" class="relative z-[999]">
        <template x-teleport="body">
            <div x-show="openReport" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-md z-[999]" x-cloak>
                <div class="bg-white dark:bg-slate-950 w-full max-w-lg rounded-[3.5rem] overflow-hidden shadow-2xl border border-white/10" @click.away="openReport = false">
                    <div class="p-12 sm:p-16">
                        <div class="w-16 h-16 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500 mb-8">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <h2 class="text-3xl font-black tracking-tighter mb-2 italic text-gradient uppercase">{{ __('Reportar Publicación') }}</h2>
                        <p class="text-slate-400 text-[10px] font-black mb-10 uppercase tracking-[0.2em] leading-relaxed">{{ __('Ayúdanos a mantener la comunidad segura. ¿Qué ocurre con este producto?') }}</p>
                        
                        <form action="{{ route('tickets.store') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="hidden" name="subject" :value="'Reporte de Producto ID: ' + prodId">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">{{ __('Describe el problema') }}</label>
                                <textarea name="message" rows="4" required class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-[1.5rem] px-8 py-5 font-bold focus:ring-2 focus:ring-brand-500 transition-all shadow-inner" placeholder="Escribe aquí los detalles..."></textarea>
                            </div>
                            <div class="flex gap-4 pt-4">
                                <button type="button" @click="openReport = false" class="flex-1 px-8 py-5 rounded-2xl font-black uppercase text-xs tracking-widest text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                                    {{ __('Cancelar') }}
                                </button>
                                <button type="submit" class="flex-1 bg-brand-600 text-white px-8 py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-brand-500/20 hover:bg-brand-700 transition-all">
                                    {{ __('Enviar Reporte') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

</div>
@endsection

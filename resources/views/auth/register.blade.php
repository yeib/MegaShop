<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-black tracking-tighter text-slate-900">{{ __('Únete a nosotros') }}</h2>
        <p class="text-slate-500 font-medium tracking-wide">{{ __('Crea tu cuenta para una experiencia premium.') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">{{ __('Nombre') }}</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="Tu nombre">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="tu@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">{{ __('Contraseña') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-brand-600 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-brand-500/40 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95 mt-4">
            {{ __('Crear cuenta') }}
        </button>

        <div class="text-center pt-4">
            <p class="text-xs font-bold text-slate-400">
                {{ __('¿Ya tienes cuenta?') }} 
                <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-700 underline">{{ __('Inicia sesión') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>

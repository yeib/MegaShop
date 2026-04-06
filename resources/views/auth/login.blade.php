<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-3xl font-black tracking-tighter text-slate-900">{{ __('Bienvenido') }}</h2>
        <p class="text-slate-500 font-medium tracking-wide">{{ __('Ingresa a tu cuenta premium.') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="tu@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2 ml-1">
                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-brand-600 hover:text-brand-700 transition-colors" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste?') }}
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full bg-slate-100 border-none rounded-2xl py-4 px-6 text-sm font-bold focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-slate-200 text-brand-600 shadow-sm focus:ring-brand-500 focus:ring-offset-0" name="remember">
            <span class="ms-3 text-xs font-bold text-slate-500">{{ __('Recordarme') }}</span>
        </div>

        <button type="submit" class="w-full bg-brand-600 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-brand-500/40 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95">
            {{ __('Entrar ahora') }}
        </button>

        <div class="text-center pt-4">
            <p class="text-xs font-bold text-slate-400">
                {{ __('¿No tienes cuenta?') }} 
                <a href="{{ route('register') }}" class="text-brand-600 hover:text-brand-700 underline">{{ __('Regístrate aquí') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>

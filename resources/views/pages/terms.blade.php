@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-12">
    <div class="space-y-4">
        <h1 class="text-5xl font-black tracking-tight leading-none italic uppercase text-gradient">{{ __('Términos y Condiciones') }}</h1>
        <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">{{ __('Última actualización: 05 de Abril, 2026') }}</p>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[3rem] p-12 md:p-20 shadow-2xl border border-brand-500/10 dark:border-brand-500/20">
        <div class="prose dark:prose-invert max-w-none space-y-10">
            <section class="space-y-4">
                <h2 class="text-2xl font-black tracking-tight flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm">1</div>
                    {{ __('Uso del Sitio') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg">
                    Bienvenido a Mega Shop. Al acceder y utilizar este sitio web, aceptas cumplir con estos términos y condiciones. Este sitio es para uso personal y no comercial.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-2xl font-black tracking-tight flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm">2</div>
                    {{ __('Productos y Precios') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg">
                    Nos esforzamos por mostrar con precisión los colores y las imágenes de nuestros productos. Todos los precios están sujetos a cambios sin previo aviso. Nos reservamos el derecho de limitar las cantidades de cualquier producto.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-2xl font-black tracking-tight flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm">3</div>
                    {{ __('Envíos y Entregas') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg">
                    Los tiempos de entrega son estimativos. Mega Shop no se hace responsable por retrasos causados por el transportista o situaciones de fuerza mayor.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-2xl font-black tracking-tight flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm">4</div>
                    {{ __('Reclamos y Devoluciones') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg">
                    Si tienes algún problema con tu pedido, puedes utilizar nuestro <strong>Centro de Soporte</strong> dentro de los primeros 10 días tras recibir tu compra para reportar cualquier inconveniente.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-2xl font-black tracking-tight flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm">5</div>
                    {{ __('Privacidad') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg">
                    Tu privacidad es importante para nosotros. Consulta nuestra política de privacidad para entender cómo manejamos tus datos personales.
                </p>
            </section>
        </div>

        <div class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-800 text-center">
            <p class="text-slate-400 text-sm font-medium italic">
                {{ __('Gracias por elegir Mega Shop. Disfruta tu experiencia premium.') }}
            </p>
        </div>
    </div>
</div>
@endsection

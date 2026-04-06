# 🛍️ Mega Shop | Teal Edition

**Mega Shop** es un sistema de comercio electrónico ligero, moderno y funcional, diseñado para ofrecer una experiencia de compra directa y una administración de inventario simplificada.

## ✨ Características Principales

- 🛒 **Carrito de Compras:** Sistema fluido para añadir, actualizar y gestionar productos antes del pago.
- 📦 **Gestión de Stock:** Panel administrativo para controlar inventario, pausar ventas y aplicar descuentos en tiempo real.
- 🎟️ **Sistema de Tickets:** Canal de comunicación integrado para soporte post-venta y reclamos.
- 💎 **VIP Products:** Sección destacada para productos exclusivos o en oferta.
- 🌍 **Multi-idioma:** Soporte nativo para Español e Inglés.
- 📱 **Diseño Responsive:** Interfaz moderna construida con Tailwind CSS, optimizada para móviles y escritorio.
- 🔍 **SEO Ready:** Etiquetas Open Graph y Twitter Cards configuradas para una vista previa perfecta en redes sociales.

## 🛠️ Stack Tecnológico

- **Framework:** [Laravel 11](https://laravel.com)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com) & [Alpine.js](https://alpinejs.dev)
- **Base de Datos:** SQLite / MySQL
- **Iconos:** Lucide Icons / Heroicons

## 🚀 Instalación Rápida

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/yeib/MegaShop.git
   ```
2. Instalar dependencias:
   ```bash
   composer install
   npm install && npm run build
   ```
3. Configurar el entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

---
Desarrollado con ❤️ por [Yeib](https://yeib.cl)

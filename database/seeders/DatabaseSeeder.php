<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Usuarios
        User::create([
            'name' => 'Admin MegaShop',
            'email' => 'admin@megashop.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@megashop.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Crear Categorías
        $categories_data = [
            ['en' => 'Technology', 'es' => 'Tecnología', 'slug' => 'technology'],
            ['en' => 'Home', 'es' => 'Hogar', 'slug' => 'home'],
            ['en' => 'Sports', 'es' => 'Deportes', 'slug' => 'sports'],
            ['en' => 'Fashion', 'es' => 'Moda', 'slug' => 'fashion'],
        ];

        foreach($categories_data as $cat) {
            Category::create([
                'name' => ['en' => $cat['en'], 'es' => $cat['es']],
                'slug' => $cat['slug']
            ]);
        }

        $cats = Category::all();

        // Crear 20 Productos con precios en CLP
        $products_data = [
            ['en' => 'Gaming Laptop', 'es' => 'Portátil Gaming', 'price' => 899990],
            ['en' => 'Wireless Mouse', 'es' => 'Ratón Inalámbrico', 'price' => 15990],
            ['en' => 'Coffee Maker', 'es' => 'Cafetera', 'price' => 45990],
            ['en' => 'Smart Watch', 'es' => 'Reloj Inteligente', 'price' => 129990],
            ['en' => 'Bluetooth Speaker', 'es' => 'Altavoz Bluetooth', 'price' => 29990],
            ['en' => 'Mechanical Keyboard', 'es' => 'Teclado Mecánico', 'price' => 55000],
            ['en' => 'Desk Lamp', 'es' => 'Lámpara de Escritorio', 'price' => 12500],
            ['en' => 'Yoga Mat', 'es' => 'Esterilla Yoga', 'price' => 9990],
            ['en' => 'Running Shoes', 'es' => 'Zapatillas Correr', 'price' => 49990],
            ['en' => 'Cotton T-Shirt', 'es' => 'Camiseta Algodón', 'price' => 7990],
            ['en' => 'Jeans Classic', 'es' => 'Vaqueros Clásicos', 'price' => 24990],
            ['en' => 'Headphones Pro', 'es' => 'Auriculares Pro', 'price' => 189990],
            ['en' => 'Electric Kettle', 'es' => 'Hervidor Eléctrico', 'price' => 19990],
            ['en' => 'Blender 500W', 'es' => 'Batidora 500W', 'price' => 34990],
            ['en' => 'Basketball Ball', 'es' => 'Pelota Baloncesto', 'price' => 14990],
            ['en' => 'Dumbbell Set', 'es' => 'Set de Pesas', 'price' => 39990],
            ['en' => 'Summer Hat', 'es' => 'Sombrero Verano', 'price' => 5990],
            ['en' => 'Leather Wallet', 'es' => 'Cartera de Cuero', 'price' => 12990],
            ['en' => 'Air Fryer', 'es' => 'Freidora de Aire', 'price' => 79990],
            ['en' => 'Monitor 27"', 'es' => 'Monitor 27 Pulgadas', 'price' => 159990],
        ];

        foreach($products_data as $index => $prod) {
            Product::create([
                'category_id' => $cats->random()->id,
                'name' => ['en' => $prod['en'], 'es' => $prod['es']],
                'description' => [
                    'en' => "High quality " . strtolower($prod['en']) . " for your needs.",
                    'es' => "Excelente " . strtolower($prod['es']) . " para tus necesidades."
                ],
                'price' => $prod['price'],
                'stock' => rand(5, 100),
                'image_url' => 'https://picsum.photos/seed/' . Str::random(5) . '/400/300',
                'slug' => Str::slug($prod['en']) . '-' . $index,
                'discount' => collect([0, 0, 10, 20, 30])->random(),
                'is_vip' => ($index < 2), // Los dos primeros son VIP
            ]);
        }
    }
}

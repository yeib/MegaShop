<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'reviews')->where('is_paused', false);

        // Buscar por nombre o descripción
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name->en', 'like', "%{$searchTerm}%")
                  ->orWhere('name->es', 'like', "%{$searchTerm}%")
                  ->orWhere('description->en', 'like', "%{$searchTerm}%")
                  ->orWhere('description->es', 'like', "%{$searchTerm}%");
            });
        }

        // Filtrar por categoría especial 'offers' o categorías normales
        if ($request->category === 'offers') {
            $query->where('discount', '>', 0);
        } elseif ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $all_products = $query->latest()->get();
        
        // Separar VIPs del resto para la vitrina destacada
        $vip_products = $all_products->where('is_vip', true)->take(2);
        $products = $all_products->where('is_vip', false);

        $categories = Category::all();
        
        // Manejar la preferencia de vista (grid o list) en la sesión
        $view = $request->get('view', session('product_view', 'grid'));
        session(['product_view' => $view]);

        return view('home', compact('products', 'vip_products', 'categories', 'view'));
    }
}

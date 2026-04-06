<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_sales' => Order::sum('total'),
            'orders_count' => Order::count(),
            'products_count' => Product::count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function productCreate()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_es' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create([
            'name' => ['en' => $request->name_en, 'es' => $request->name_es],
            'description' => ['en' => $request->desc_en, 'es' => $request->desc_es],
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $request->image_url ?? 'https://picsum.photos/400/300',
            'slug' => Str::slug($request->name_en) . '-' . time(),
        ]);

        return redirect()->route('admin.products')->with('success', 'Producto creado con éxito.');
    }

    public function updateStock(Request $request, Product $product)
    {
        $product->update(['stock' => $request->stock]);
        return back()->with('success', 'Stock actualizado.');
    }

    public function updateDiscount(Request $request, Product $product)
    {
        $product->update(['discount' => $request->discount]);
        return back()->with('success', 'Descuento actualizado.');
    }

    public function togglePause(Product $product)
    {
        $product->update(['is_paused' => !$product->is_paused]);
        $status = $product->is_paused ? 'pausado' : 'publicado';
        return back()->with('success', "Producto {$status} con éxito.");
    }

    public function productDelete(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Producto eliminado.');
    }

    public function orders()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // CATEGORIES
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => ['en' => $request->name_en, 'es' => $request->name_es],
            'slug' => Str::slug($request->name_en),
        ]);

        return back()->with('success', 'Categoría creada con éxito.');
    }

    public function categoryUpdate(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => ['en' => $request->name_en, 'es' => $request->name_es],
            'slug' => Str::slug($request->name_en),
        ]);

        return back()->with('success', 'Categoría actualizada.');
    }

    public function categoryDelete(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'No puedes eliminar una categoría con productos asociados.');
        }
        $category->delete();
        return back()->with('success', 'Categoría eliminada.');
    }
}

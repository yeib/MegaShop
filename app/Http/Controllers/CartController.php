<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->translated_name,
                "quantity" => 1,
                "price" => $product->final_price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', __('¡Producto añadido al carrito!'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $quantity = $request->quantity;
            if($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]["quantity"] = $quantity;
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', __('Carrito actualizado.'));
        }
        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', __('Producto eliminado.'));
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('Please login to checkout'));
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', __('Your cart is empty!'));
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $product = Product::find($id);
            if (!$product || $product->stock < $details['quantity']) {
                return redirect()->route('cart.index')->with('error', "No hay suficiente stock para {$details['name']}");
            }
            $total += $details['price'] * $details['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('home');

        try {
            DB::transaction(function () use ($cart) {
                $total = 0;
                foreach($cart as $id => $details) {
                    $product = Product::lockForUpdate()->find($id);
                    
                    if ($product->stock < $details['quantity']) {
                        throw new \Exception("Stock insuficiente para {$product->translated_name}");
                    }

                    // Descontar Stock
                    $product->decrement('stock', $details['quantity']);
                    $total += $details['price'] * $details['quantity'];
                }

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total' => $total,
                    'status' => 'completed'
                ]);

                foreach ($cart as $id => $details) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                    ]);
                }

                session()->forget('cart');
            });

            return redirect()->route('orders.index')->with('success', __('Movimiento de prueba exitoso y stock actualizado.'));
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
}

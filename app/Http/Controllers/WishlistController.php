<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistProducts()->with('category')->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            $status = 'added';
        }

        if (request()->wantsJson()) {
            return response()->json(['status' => $status]);
        }

        return back()->with('success', __('Wishlist updated.'));
    }
}

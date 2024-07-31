<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Produk;
use App\Models\Topping;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        // return $cartItems;
        $meja = Meja::where('status', 'kosong')->get();

        return view('cart.index', compact('cartItems', 'meja'));
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $product = Produk::findOrFail($request->product_id);
        $toppings = Topping::find($request->toppings);

        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->nama_produk,
            'price' => $product->harga,
            'quantity' => 1,
            'attributes' => [
                'toppings' => $toppings,
            ],
        ]);
        // return $cartItem;


        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        Cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        Cart::clear();

        return redirect()->route('cart.index')->with('success', 'All products removed from cart!');
    }
}

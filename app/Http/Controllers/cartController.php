<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meja;
use App\Models\produk;
use Darryldecode\Cart\Facades\CartFacade as cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = cart::getContent();
        $meja = meja::where('status', 'kosong')->get();

        return view('cart.index', compact('cartItems', 'meja'));
    }

    public function add(produk $product)
    {
        // dd($product);
        cart::add([
            'id' => $product->id,
            'name' => $product->nama_produk,
            'price' => $product->harga,
            'quantity' => 1,
        ]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        cart::clear();

        return redirect()->route('cart.index')->with('success', 'All products removed from cart!');
    }
}

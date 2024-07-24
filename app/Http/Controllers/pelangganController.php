<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\Topping;
use Illuminate\Http\Request;
class pelangganController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $toppings = Topping::all(); // Mengambil semua topping

        return view('listmenu.index', compact('produk', 'toppings')); // Mengirimkan data produk dan topping ke view
    }
}

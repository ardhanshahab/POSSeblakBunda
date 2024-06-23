<?php

namespace App\Http\Controllers;
use App\Models\produk;
use Illuminate\Http\Request;

class landingpageController extends Controller
{
    public function welcome()
    {
        $produk = Produk::take(6)->get(); // Mengambil hanya 6 produk
        return view('welcome', compact('produk')); // Meneruskan data produk ke view
    }
}

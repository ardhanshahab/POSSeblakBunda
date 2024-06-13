<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
class pelangganController extends Controller
{
    public function index()
    {
        $produk = produk::all();
        return view('listmenu.index', compact('produk'));
    }
}

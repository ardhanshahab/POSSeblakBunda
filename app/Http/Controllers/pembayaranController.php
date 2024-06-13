<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class pembayaranController extends Controller
{
    public function store(Request $request)
    {
        $products = $request->input('products');
        $total = $request->input('total');
        $meja = $request->input('no_meja');

        // Buat data untuk PDF
        $data = [
            'products' => $products,
            'total' => $total,
            'meja' => $meja
        ];

        // Generate PDF
        $pdf = Pdf::loadView('cart.struk', $data);

        // Simpan data ke session untuk diambil di halaman index
        session(['payment_data' => $data]);

        // Simpan PDF sementara dan buat respons unduhan
        $pdfPath = storage_path('app/public/receipt.pdf');
        $pdf->save($pdfPath);

        // Flash message untuk pesan sukses
        Session::flash('message', 'Payment data saved successfully');

        // Kembalikan view yang memuat script untuk mengunduh PDF dan mengarahkan ke index
        return view('cart.download')->with('pdfPath', asset('storage/receipt.pdf'));
    }

    public function index()
    {
        // Ambil data dari session
        $data = session('payment_data', []);

        // Kembalikan view dengan data
        return view('pembayaran.index', compact('data'));
    }
}

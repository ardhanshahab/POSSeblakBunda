<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;
use App\Models\Meja;
use App\Models\Fcfs;
use App\Models\Topping;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class PembayaranController extends Controller
{
    public function index()
    {
        // Ambil data dari session
        $data = session('payment_data', []);
        // return $data;
        // Kembalikan view dengan data
        return view('pembayaran.index', compact('data'));
    }
    public function store(Request $request)
{
    try {
        // Membuat order baru
        $order = new Order();
        $order->no_meja = $request->no_meja;
        $order->invoice_number = 'INV-' . time();
        $order->amount = $request->total;
        $order->status = 'Proses Pembuatan Pesanan';
        $order->catatan = $request->catatan;
        // $order->save();

        $products = [];

        foreach ($request->products as $orderItem) {
            $detail = new OrderDetail();
            $detail->product_id = $orderItem['product_id'];
            $detail->quantity = $orderItem['quantity'];

            $product = Produk::find($detail->product_id);
            if ($product) {
                $detail->total = $detail->quantity * $product->harga;
                $toppings = [];
            if (isset($orderItem['toppings']) && is_array($orderItem['toppings'])) {
                foreach ($orderItem['toppings'] as $toppingName) {
                    // Assuming you have a way to get topping price, e.g., from a Topping model
                    $toppingPrice = Topping::where('name', $toppingName)->value('price');
                    $toppings[] = [
                        'name' => $toppingName,
                        'price' => $toppingPrice
                    ];
                }
            }
            // Convert toppings array to JSON before saving to the database
            $detail->toppings = json_encode($toppings);

                $products[] = [
                    'name' => $product->nama_produk,
                    'quantity' => $detail->quantity,
                    'price' => $product->harga,
                    'total' => $detail->total,
                    'toppings' => $toppings,
                ];
            } else {
                return response()->json(['message' => 'Failed to create order', 'error' => 'Invalid product_id'], 500);
            }

            $detail->order_id = $order->id;
            $detail->save();
        }

        // Update status meja
        $post = Meja::find($request->no_meja);
        if (!$post) {
            return response()->json(['message' => 'Failed to create order', 'error' => 'No Meja found for no_meja: ' . $request->no_meja], 404);
        }
        $post->update(['status' => 'Terisi']);

        // Membuat FCFS entry
        $fcfs = Fcfs::create([
            'invoice_number' => $order->invoice_number,
        ]);
        $fcfs->setOrderTime();

        // Buat data untuk PDF
        $data = [
            'products' => $products,
            'total' => $order->amount,
            'meja' => $order->no_meja
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
        Cart::clear();
        // Kembalikan view yang memuat script untuk mengunduh PDF dan mengarahkan ke index
        return view('cart.download')->with('pdfPath', asset('storage/receipt.pdf'));
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
    }
}







}


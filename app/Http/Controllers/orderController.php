<?php

namespace App\Http\Controllers;

use App\Models\kategoriproduk;
use App\Models\meja;
use App\Models\order;
use App\Models\OrderDetail;
use App\Models\produk;
use App\Models\fcfs;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class orderController extends Controller
{
    public function index()
    {
        return view ('order.index');
    }

    public function getOrder()
    {
         $posts = order::with('orderDetails')->get();

         return response()->json([
            'success' => true,
            'message' => 'List Peserta',
            'data' => $posts,
        ]);
    }

    public function getOrderDetail($invoice_number)
    {
        // Ambil order berdasarkan invoice_number
        $order = Order::where('invoice_number', $invoice_number)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Ambil detail order
        $orderDetails = OrderDetail::with('produk')->where('order_id', $order->id)->get();

        return response()->json($orderDetails);
    }


    public function cashier()
    {
        $data['product']  = produk::all();
        $data['category'] = kategoriproduk::all();
        $meja = meja::where('status', 'kosong')->get();
        return view ('cashier.index', compact('data', 'meja'));
    }

    // public function create()
    // {
    //     return view('backend.master.order.create');
    // }

    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $order = new Order();
            $order->no_meja = $request->orders[0]['no_meja'];
            $order->invoice_number = 'INV-' . time();
            $order->amount = $request->amount;
            $order->catatan = $request->catatan;
            $order->status = 'Proses Pembuatan Pesanan';
            $order->save();

            foreach ($request->orders as $orderItem) {
                    $detail = new OrderDetail();
                    $detail->product_id = $orderItem['product_id'];
                    $detail->quantity = $orderItem['quantity'];
                    // Pastikan $detail->product tidak null sebelum mengakses properti price
                    $product = produk::find($detail->product_id);
                    // dd($product);
                    if ($product) {
                        $detail->total = $detail->quantity * $product->harga;
                    } else {
                        // Handle error jika product_id tidak valid
                        return response()->json(['message' => 'Failed to create order', 'error' => 'Invalid product_id'], 500);
                    }
                    // $detail->total = $detail->quantity * $detail->product->price;
                    $detail->order_id = $order->id;
                    $detail->save();
            }
            $post = meja::findOrFail($order->no_meja);

            $post->update([
                'status'     => 'Terisi',
            ]);

            $order = Fcfs::create([
                'invoice_number' =>  $order->invoice_number,
            ]);

            // Set order time when the order is created
            $order->setOrderTime();

            $data = [
                'products' => $request->orders,
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

            return response()->json(['message' => 'Order successfully created', 'order' => $order], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }


}

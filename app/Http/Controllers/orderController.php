<?php

namespace App\Http\Controllers;

use App\Models\kategoriproduk;
use App\Models\meja;
use App\Models\order;
use App\Models\OrderDetail;
use App\Models\produk;
use Illuminate\Http\Request;

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

            return response()->json(['message' => 'Order successfully created', 'order' => $order], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }


}

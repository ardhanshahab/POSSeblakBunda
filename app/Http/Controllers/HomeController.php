<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\produk;
use App\Models\Fcfs;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Minggu ini dimulai dari hari Senin
        $endOfWeek = Carbon::now()->endOfWeek(); // Minggu ini berakhir pada hari Minggu

        $orders = Order::with('fcfs')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        // return $orders;
        $totalOrderTime = 0;
        $totalOrderCompletedTime = 0;
        $totalCustomerLeftTime = 0;

        foreach ($orders as $order) {
            if ($order->fcfs) {
                $orderTime = Carbon::parse($order->fcfs->order_time);
                $orderCompletedTime = Carbon::parse($order->fcfs->order_completed_time);
                $customerLeftTime = Carbon::parse($order->fcfs->customer_left_time);

                // Hitung durasi dari waktu memesan hingga waktu pesanan selesai
                $totalOrderTime += $orderTime->diffInMinutes($orderCompletedTime);

                // Hitung durasi dari waktu pesanan selesai hingga waktu pelanggan pulang
                $totalCustomerLeftTime += $orderCompletedTime->diffInMinutes($customerLeftTime);
            }
        }

        $totalOrders = count($orders);
        $averageOrderTime = $totalOrders ? $totalOrderTime / $totalOrders : 0;
        $averageCustomerLeftTime = $totalOrders ? $totalCustomerLeftTime / $totalOrders : 0;
        // return $order;
        return view('home', compact('orders', 'averageOrderTime', 'averageCustomerLeftTime', 'totalOrderTime', 'totalCustomerLeftTime'));
    }




    public function welcome()
    {
        $produk = Produk::take(6)->get(); // Mengambil hanya 6 produk
        return view('welcome', compact('produk')); // Meneruskan data produk ke view
    }

    public function completeOrder($id)
    {
        // dd($id);
        $order = Fcfs::findOrFail($id);
        $order->setOrderCompletedTime();

        return redirect()->route('home');
    }

    public function customerLeft($id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::with('fcfs')->findOrFail($id);

        // Perbarui status pesanan
        $order->status = 'Pesanan Selesai';
        $order->save();

        // Temukan data Fcfs terkait dan perbarui waktu pelanggan meninggalkan meja
        $fcfs = $order->fcfs;
        if ($fcfs) {
            $fcfs->customer_left_time = now();
            $fcfs->save();
        }

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('message', 'Pesanan berhasil diselesaikan.');
    }


}

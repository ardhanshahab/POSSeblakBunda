@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th rowspan="2">Invoice</th>
                                <th rowspan="2">Meja</th>
                                <th rowspan="2">Pesanan</th> <!-- This keeps the first three columns aligned -->
                                <th colspan="3">Waktu</th>
                                <th rowspan="2">Aksi</th>

                            </tr>
                            <tr>

                                <th>Memesan</th>
                                <th>Pesanan Selesai</th>
                                <th>Pelanggan Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                @php
                                    $orderDetailsCount = $order->orderDetails->count();
                                @endphp
                               @foreach ($order->orderDetails as $index => $o)
                               {{-- {{ $o }} --}}
                               <tr>
                                   @if ($index == 0)
                                       <td rowspan="{{ $orderDetailsCount }}">{{ $order->invoice_number }}</td>
                                       <td rowspan="{{ $orderDetailsCount }}">{{ $order->no_meja }}</td>
                                   @endif
                                   <td>
                                    {{ $o->produk->nama_produk }}
                                    @php
                                        $toppings = json_decode($o->toppings, true);
                                    @endphp
                                    @if (!empty($toppings))
                                        @foreach ($toppings as $topping)
                                            ({{ $topping['name'] }} @if (isset($topping['price'])) - {{ $topping['price'] }} @endif)
                                        @endforeach
                                    @endif
                                </td>

                                   @if ($index == 0)
                                       <td rowspan="{{ $orderDetailsCount }}">{{ \Carbon\Carbon::parse($order->fcfs->order_time)->translatedFormat('l, d F Y H:i:s') }}</td>
                                       <td rowspan="{{ $orderDetailsCount }}">{{ \Carbon\Carbon::parse($order->fcfs->order_completed_time)->translatedFormat('l, d F Y H:i:s') }}</td>
                                       <td rowspan="{{ $orderDetailsCount }}">{{ \Carbon\Carbon::parse($order->fcfs->customer_left_time)->translatedFormat('l, d F Y H:i:s') }}</td>
                                       <td rowspan="{{ $orderDetailsCount }}">
                                            @if (!$order->fcfs->order_completed_time && !$order->fcfs->customer_left_time)
                                               <form action="{{ route('completeOrder', ['id' => $order->id]) }}" method="POST">
                                                   @csrf
                                                   <button type="submit" class="btn btn-primary">Pesanan Siap</button>
                                               </form>
                                            @elseif ($order->fcfs->order_completed_time && !$order->fcfs->customer_left_time)
                                               <form action="{{ route('customerLeft', ['id' => $order->id]) }}" method="POST">
                                                   @csrf
                                                   <button type="submit" class="btn btn-primary">Pelanggan Pulang</button>
                                               </form>
                                            @elseif ($order->status == 'Kosongkan Meja')
                                                <span class="badge bg-success">Pesanan Selesai</span>
                                            @else
                                               <form action="{{ route('updateMeja', $order->no_meja) }}" method="POST">
                                                   @csrf
                                                   @method('PUT')
                                                   <input type="hidden" name="status" value="Kosong">
                                                   <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                   <button type="submit" class="btn btn-primary">Kosongkan Meja</button>
                                               </form>
                                           @endif
                                       </td>
                                   @endif
                               </tr>
                           @endforeach
                           <tr style="border-bottom: 1pt solid black;">
                               <td colspan="1">Catatan</td>
                               <td colspan="6" class="text-left">{{ $order->catatan }}</td>
                           </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pesanan hari ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            @if ($orders->count() > 0)
                                <tr>
                                    <td colspan="3" rowspan="2">Total</td>
                                    <td colspan="1">Durasi Pembuatan Pesanan</td>
                                    <td colspan="1">Durasi Pelanggan Hadir</td>
                                    <td colspan="2">Total Durasi</td>
                                </tr>
                                <tr>
                                    {{-- <td colspan="3"></td> --}}
                                    <td colspan="1">{{ Carbon\CarbonInterval::minutes($totalOrderTime)->cascade()->forHumans() }}</td>
                                    <td colspan="1">{{ Carbon\CarbonInterval::minutes($totalCustomerLeftTime)->cascade()->forHumans() }}</td>
                                    <td colspan="2">{{ Carbon\CarbonInterval::minutes($totalOrderTime + $totalCustomerLeftTime)->cascade()->forHumans() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" rowspan="2">Rata-rata</td>
                                    <td colspan="1">Durasi Pembuatan Pesanan</td>
                                    <td colspan="1">Durasi Pelanggan Hadir</td>
                                    <td colspan="2">Rata-rata Durasi</td>
                                </tr>
                                <tr>
                                    {{-- <td colspan="3">Rata-rata</td> --}}
                                    <td colspan="1">{{ Carbon\CarbonInterval::minutes($averageOrderTime)->cascade()->forHumans() }}</td>
                                    <td colspan="1">{{ Carbon\CarbonInterval::minutes($averageCustomerLeftTime)->cascade()->forHumans() }}</td>
                                    <td colspan="2">{{ Carbon\CarbonInterval::minutes(($averageOrderTime + $averageCustomerLeftTime) / 2)->cascade()->forHumans() }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pesanan hari ini</td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.kasir')

@section('content')
<div class="container-fluid">
    @if (session('payment_data'))
    <div class="alert alert-success">
        Silahkan scan QRIS atau segera ke kasir.
    </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <a href="/" class="btn btn-primary">Back</a>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <img src="{{ asset('assets/images/qris.jpeg') }}" alt="qris" style="max-width: 500px">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Payment Details</h2>
            <p>Table Number: {{ $data['meja'] }}</p>
            <p>Total: {{ $data['total'] }}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Toppings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['products'] as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['price'] }}</td>
                            <td>
                                @if (!empty($product['toppings']))
                                    <ul>
                                        @foreach ($product['toppings'] as $topping)
                                            <li>{{ $topping['name'] }} @if (isset($topping['price'])) ({{ $topping['price'] }}) @endif</li>
                                        @endforeach
                                    </ul>
                                @else
                                    No toppings
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

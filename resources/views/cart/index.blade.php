@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang</h1>
    <a href="/listmenu" class="btn btn-primary my-2">Tambah Menu</a>
    @if($cartItems->isEmpty())
        <p>Your cart is empty</p>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @php $total = 0; @endphp
                            @foreach ($cartItems as $item)
                                @php $total += $item->price * $item->quantity; @endphp
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            <p class="card-text">Banyaknya: {{ $item->quantity }}</p>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h4>Total Harga: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Clear Cart</button>
                                </form>
                                <form action="{{ route('pembayaran.store') }}" method="POST">
                                    @csrf
                                    <select name="no_meja" id="no_meja" class="form-select">
                                        <option value="" selected>Pilih Meja</option>
                                        @foreach ($meja as $post)
                                            <option value="{{ $post->no_meja }}">{{ $post->no_meja }}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($cartItems as $item)
                                        <input type="hidden" name="products[{{ $item->id }}][product_id]" value="{{ $item->id }}">
                                        <input type="hidden" name="products[{{ $item->id }}][name]" value="{{ $item->name }}">
                                        <input type="hidden" name="products[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                                        <input type="hidden" name="products[{{ $item->id }}][price]" value="{{ $item->price }}">
                                        <input type="hidden" name="total" value="{{ $total }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-warning">Proses Pembayaran</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

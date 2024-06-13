@extends('layouts.app')
@section('content')
  <section class="recipe_section">
    <div class="container-fluid">
      <div class="heading_container heading_center">
        <h2>
          List menu
        </h2>
      </div>
      <div class="row">
        @foreach ( $produk as $item)
        <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box">
              <div class="img-box">
                <img src="/storage/posts/{{ $item->image }}" alt="Product Image" style="width: auto; height: 250px;">
              </div>
              <div class="detail-box">
                <h4>
                  {{ $item->nama_produk }}
                </h4>
                <p>
                    {{ $item->deskripsi }}
                </p>
                <p>
                    {{ $item->harga }}
                </p>
                <form action="{{ route('cart.add', $item) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
                {{-- <a href="{{ route('cart.add', $item->id) }}">
                    cart
                </a> --}}
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>
  @endsection

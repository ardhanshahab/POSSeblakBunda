@extends('layouts.app')
@section('content')
  <section class="recipe_section layout_padding-top">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Best Menus
        </h2>
      </div>
      <div class="row">
        @foreach ($produk->take(3) as $item)
            <div class="col-sm-6 col-md-4 mx-auto">
                <div class="box">
                    <div class="img-box">
                        <img src="/storage/posts/{{ $item->image }}" alt="Product Image" style="width: 250px; height: auto;">
                    </div>
                    <div class="detail-box">
                        <h4>
                        {{ $item->nama_produk }}
                        </h4>
                        {{-- <a href="">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
        @endforeach

      </div>
      <div class="btn-box">
        <a href="/listmenu">
          Order Now
        </a>
      </div>
    </div>
  </section>
  @endsection

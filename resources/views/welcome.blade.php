@extends('layouts.welcome')
@section('content')
<section class="site-cover" id="section-home">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center site-vh-100">
        <div class="col-md-12">
          <h1 class="site-heading site-animate mb-3">Welcome To Seblak Bunda Raziel</h1>
          <h2 class="h5 site-subheading mb-5 site-animate">Come and eat well with our delicious &amp; spicy foods.</h2>
          <p><a href="https://colorlib.com/" target="_blank" class="btn btn-outline-white btn-lg site-animate" data-toggle="modal" data-target="#reservationModal">Order Now!</a></p>
        </div>
      </div>
    </div>
</section>
<section class="site-section bg-light" id="section-offer">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mb-5 site-animate">
          <h4 class="site-sub-title">Menu Kita hari ini</h4>
          <h2 class="display-4">Menu Kita hari ini</h2>
          <div class="row justify-content-center">
            <div class="col-md-7">
              {{-- <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> --}}
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="owl-carousel site-owl">
            @foreach ($produk as $item)
                <div class="item">
                <div class="media d-block mb-4 text-center site-media site-animate border-0">
                    <img src="/storage/posts/{{ $item->image }}" alt="Free Template by colorlib.com" class="img-fluid">
                    <div class="media-body p-md-5 p-4">
                    <h5 class="text-primary">$19.50</h5>
                    <h5 class="mt-0 h4">{{ $item->nama_produk }}</h5>
                    {{-- <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> --}}

                    <p class="mb-0"><a href="#" class="btn btn-primary btn-sm">Order Now!</a></p>
                    </div>
                </div>
                </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
</section>

  <style>
    #section-home {
        background-image: url('{{ asset('aset/images/seblak.jpg') }}');
        /* Atur properti CSS tambahan sesuai kebutuhan Anda */
        background-size: cover;
        background-position: center;
        /* background-repeat: inherit; */
    }
  </style>
@endsection

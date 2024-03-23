@extends('layoutguest')

@section('content')
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1>Resto Seblak Bunda</h1>
      <p class="lead text-muted">Seblak adalah masakan khas Sunda yang berasal dari wilayah Parahyangan dengan cita rasa gurih dan pedas. Seblak umumnya terbuat dari kerupuk yang terdiri dari bawang putih dengan kencur.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Pesan Sekarang!</a>
        {{-- <a href="#" class="btn btn-secondary my-2">Secondary action</a> --}}
      </p>
    </div>
  </section>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        {{-- {{ $menu }} --}}
        @foreach ( $menu as $menus )
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{ asset('storage/menu_images/' . $menus->foto) }}" alt="{{ $menus->menu_name }}">
            <div class="card-body">
                <h3>{{ $menus->menu_name }}</h3>
              <p class="card-text">{{ $menus->description }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Pesan Sekarang!</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>

</main>

{{--  --}}
@endsection

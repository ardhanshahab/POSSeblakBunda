@extends('master')

@section('title', 'Manager')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{ session ('success') }}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session ('danger') }}
</div>
@endif

<div class="card">
   <div class="card-body">
      <h4 class="card-title">All Menu</h4>
      <a href="{{ route('manager.create') }}"><button type="button" class="btn btn-primary btn-fw">Create
            Menu</button></a>
      @if ($menus->count())
      <div class="table-responsive mt-4">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Nama Menu</th>
                  <th>Harga</th>
                  <th>Deskropso</th>
                  <th>Stok</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($menus as $menu)
               <tr>
                  <td>{{ $menus->firstItem() + $loop->index }}</td>
                  <td><img src="{{ asset('storage/menu_images/' . $menu->foto) }}" alt="{{ $menu->menu_name }}" width="100px" class="foto_menu"></td>
                  <td>{{ $menu->menu_name }}</td>
                  <td>{{ 'Rp '. number_format($menu->price) }}</td>
                  <td>{{ Str::limit($menu->description, 25, '...') }}</td>
                  <td>{{ $menu->stock }}</td>
                  <td>
                     <a href="/manager/dashboard/edit/{{ $menu->id }}"><button type="button" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                     <a href="/manager/dashboard/delete/{{ $menu->id }}" onclick="return confirm('Are you sure to delete?')"><button type="button"
                           class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="mt-4">
            {{ $menus->links() }}
         </div>
      </div>
      @else
      <p class="text-center h4 mt-5 mb-3">No Menus Found</p>
      @endif
   </div>
</div>
<style>
    .foto-menu{
        width: auto;
        height: 200px;
    }
</style>
@endsection

@extends('master')

@section('title', 'Edit Menu')

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit menu page</h3>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Update menu</h4>
            <form class="forms-sample" action="/manager/dashboard/update/{{ $menus->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputMenuName">Menu name</label>
                    <input type="text" class="form-control @error('menu_name') is-invalid @enderror" id="inputMenuName"
                        name="menu_name" placeholder="Menu name" value="{{ $menus->menu_name }}">
                    @error('menu_name')
                    <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPrice">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputPrice"
                        name="price" placeholder="Price" value="{{ $menus->price }}">
                    @error('price')
                    <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="inputDescription"
                        name="description" placeholder="Description" value="{{ $menus->description }}">
                    @error('description')
                    <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputStock">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="inputStock"
                        name="stock" placeholder="Stock" value="{{ $menus->stock }}">
                    @error('stock')
                    <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputFoto">Foto</label>
                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="inputFoto"
                        name="foto">
                    @error('foto')
                    <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

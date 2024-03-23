@extends('master');

@section('title', 'Create Menu')

@section('content')
<div class="page-header">
   <h3 class="page-title">Create menu page</h3>
</div>
<div class="col-12 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Create menu</h4>
         <form class="forms-sample" enctype="multipart/form-data" action="{{ route('manager.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputFoto">Foto</label>
                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="inputFoto" name="foto">
                @error('foto')
                <span class="text-red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
               <label for="inputMenuName">Menu name</label>
               <input type="text" class="form-control @error('menu_name') is-invalid @enderror" id="inputMenuName" name="menu_name"
                  placeholder="Menu name">
               @error('menu_name')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputPrice">Price</label>
               <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputPrice"
                  name="price" placeholder="Price">
               @error('price')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputDescription">Description</label>
               <input type="text" class="form-control @error('description') is-invalid @enderror" id="inputDescription"
                  name="description" placeholder="Description">
               @error('description')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputStock">Stock</label>
               <input type="number" class="form-control @error('stock') is-invalid @enderror" id="inputStock"
                  name="stock" placeholder="Stock">
               @error('stock')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection

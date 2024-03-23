@extends('master');

@section('title', 'Edit Transaction')

@section('content')
<div class="page-header">
   <h3 class="page-title">Edit transaction page</h3>
</div>
<div class="col-12">
   @if (session('danger'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session ('danger') }}
   </div>
   @endif
</div>
<div class="col-12 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Update transaction</h4>
         <form class="forms-sample" action="/kasir/dashboard/update/{{ $transactions->id }}" method="POST">
            @csrf
            <input type="hidden" name="old_qty" value="{{ $transactions->qty }}">
            <div class="form-group">
               <label for="inputCustomerName">Customer Name</label>
               <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                  id="inputCustomerName" name="customer_name" placeholder="Customer Name" value="{{ $transactions->customer_name }}">
               @error('customer_name')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="selectMenu">Menu</label>
               <select name="menu_name" class="form-control" id="selectMenu">
                  @foreach ($menus as $menu)
                  <option value="{{ $menu }}" @if($menu == $transactions->menu_name) selected @endif>{{ $menu }}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group">
               <label for="inputQty">Quantity</label>
               <input type="number" class="form-control @error('qty') is-invalid @enderror" id="inputQty" name="qty"
                  placeholder="Quantity" value="{{ $transactions->qty }}">
               @error('qty')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection
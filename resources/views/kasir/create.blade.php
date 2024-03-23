@extends('master');

@section('title', 'Create Transaction')

@section('content')
<div class="page-header">
   <h3 class="page-title">Create transaction page</h3>
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
         <h4 class="card-title">Create transaction</h4>
         <form class="forms-sample" action="{{ route('kasir.store') }}" method="POST">
            @csrf
            <div class="form-group">
               <label for="inputCustomerName">Customer Name</label>
               <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="inputCustomerName" name="customer_name" placeholder="Customer Name">
               @error('customer_name')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="selectMenu">Menu</label>
               <select name="menu_name" class="form-control" id="selectMenu" onchange="getHarga($(this).val())">
               @foreach ($menus as $menu)
                  <option value="{{ $menu->menu_name }}">{{ $menu->menu_name }} - (Stock : {{ $menu->stock }})</option>
               @endforeach
               </select>
            </div>
            <div class="form-group">
               <label for="harga">Harga</label>
               <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                  placeholder="Harga" disabled style="color: #000">
               @error('harga')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputQty">Quantity</label>
               <input type="number" class="form-control @error('qty') is-invalid @enderror" id="inputQty"
                  name="qty" min="1" placeholder="Quantity" onkeyup="getTotalHarga($(this).val())" onchange="getTotalHarga($(this).val())">
               @error('qty')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputTotalHarga">Total Harga</label>
               <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="inputTotalHarga"
                  name="total_harga" placeholder="Total Harga" disabled style="color: #000">
               @error('total_harga')
               <span class="text-red">{{ $message }}</span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection
@section('cjs')
   <script>
      function getHarga(menu_name) {
         $.ajax({
            url: '/cari-menu',
            data: {
               _token: "{{ csrf_token() }}",
               menu_name
            },
            type: 'POST', 
            success: (menu) => {
               // console.log(menu);
               $('#harga').val(menu.price_rp)
            },
            error: (error) => {
               console.log(error);
            }
         })
      }

      function getTotalHarga(qty) {
         const hargaMenu = $('#harga').val().replace('Rp ', '').replace('.', '')
         var totalHarga = hargaMenu * qty;
         $('#inputTotalHarga').val(totalHarga);
         $('#inputTotalHarga').val(formatRupiah($('#inputTotalHarga').val(), 'Rp '));
      }

      function formatRupiah(angka, prefix){
         var number_string = angka.replace(/[^,\d]/g, '').toString(),
         split = number_string.split(','),
         sisa = split[0].length % 3,
         rupiah = split[0].substr(0, sisa),
         ribuan = split[0].substr(sisa).match(/\d{3}/gi);
         
         // tambahkan titik jika yang di input sudah menjadi angka ribuan
         if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join(',');
         }
         
         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
         return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
      }
   </script>
@endsection
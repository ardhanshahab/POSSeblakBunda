@extends('master');

@section('title', 'Kasir')

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
      <h4 class="card-title">All Transaction</h4>
      <a href="{{ route('kasir.create') }}"><button type="button" class="btn btn-primary btn-fw">Create Transaction</button></a>
      @if ($transactions->count())
      <div class="table-responsive mt-4">
         <table class="table table-bordered mb-4">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Customer Name</th>
                  <th>Menu</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Employee Name</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($transactions as $transaction)
               <tr>
                  <td>{{ $transactions->firstItem() + $loop->index }}</td>
                  <td>{{ $transaction->customer_name }}</td>
                  <td>{{ $transaction->menu_name }}</td>
                  <td>{{ $transaction->qty }}</td>
                  <td>{{ 'Rp ' . number_format($transaction->total, 0,'.', '.') }}</td>
                  <td>{{ $transaction->employee_name }}</td>
                  <td>
                     <a href="/kasir/dashboard/edit/{{ $transaction->id }}"><button type="button"
                           class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                     {{-- <form action="/kasir/dashboard/delete/{{ $transaction->id }}" method="POST">
                        @csrf --}}
                        <a href="/kasir/dashboard/delete/{{ $transaction->id }}" onclick="return confirm('Are you sure to delete?')"><button type="button"
                           class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button></a>
                     {{-- </form> --}}
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $transactions->links() }}
      </div>
      @else
      <p class="text-center h4 mt-5 mb-3">No Transactions Found</p>
      @endif
   </div>
</div>
@endsection
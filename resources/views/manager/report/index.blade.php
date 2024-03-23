@extends('master');

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
      <h4 class="card-title">All Report</h4>
      <form class="form-inline">
         <label class="form-label">Filter Data: </label>
         <div class="col-md-8">
            <label class="sr-only" for="inputDate1">Date 1</label>
            <input type="date" name="date_1" class="form-control mb-2 mr-sm-2" id="inputDate1"/>
            <label class="sr-only" for="inputDate2">Date 2</label>
            <input type="date" name="date_2" class="form-control mb-2 mr-sm-2" id="inputDate2"/>
            <button type="submit" class="btn btn-primary"><i class="mdi mdi-filter-outline"></i>Filter</button>
         </div>
         @if (request()->has('date_1') || request()->has('date_2'))
            <a href="/manager/dashboard/export-pdf" class="btn btn-danger" style="position: absolute; right: 35px;"><i
                  class="bi bi-printer"></i> Export PDF</a>
         @else
            <a href="/manager/dashboard/export-pdf?all_data=true" class="btn btn-danger" style="position: absolute; right: 35px;"><i class="bi bi-printer"></i> Export PDF</a>
         @endif
      </form>
      @if ($reports->count())
      <div class="table-responsive mt-4">
         <table class="table table-bordered mb-4">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Customer Name</th>
                  <th>Menu Name</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Employee Name</th>
                  <th>Transaction At</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($reports as $key => $report)
               <tr>
                  <td>{{ $reports->firstItem() + $key }}</td>
                  <td>{{ $report->customer_name }}</td>
                  <td>{{ $report->menu_name }}</td>
                  <td>{{ $report->qty }}</td>
                  <td>{{ 'Rp ' . number_format($report->total) }}</td>
                  <td>{{ $report->employee_name }}</td>
                  <td>{{ date('d-m-Y', strtotime($report->created_at)) }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $reports->links() }}
      </div>
      @else
      <p class="text-center h4 mt-5 mb-3">No Reports Found</p>
      @endif
   </div>
</div>
@endsection
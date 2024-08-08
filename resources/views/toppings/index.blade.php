@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Toppings') }}</div>
                <div class="card-body">
                    <a href="{{ route('toppings.create') }}" class="btn btn-primary mb-3">Add Topping</a>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($toppings as $topping)
                        <tr>
                            <td>{{ $topping->name }}</td>
                            <td>{{ $topping->price }}</td>
                            <td>{{ $topping->tipe }}</td>
                            <td>{{ $topping->status }}</td>
                            <td>
                                <a href="{{ route('toppings.edit', $topping->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('toppings.destroy', $topping->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

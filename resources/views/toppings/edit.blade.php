@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Topping') }}</div>
                <div class="card-body">
                    <form action="{{ route('toppings.update', $topping->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $topping->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ $topping->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="tersedia">Tersedia</option>
                                <option value="habis">Habis</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

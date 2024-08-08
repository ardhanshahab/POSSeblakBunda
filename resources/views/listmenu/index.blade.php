@extends('layouts.app')

@section('content')
<section class="recipe_section">
    <div class="container-fluid">
        <div class="heading_container heading_center">
            <h2>List menu</h2>
        </div>
        <div class="row">
            @foreach ($produk as $item)
            <div class="col-sm-6 col-md-4 mx-auto">
                <div class="box">
                    <div class="img-box">
                        <img src="/storage/posts/{{ $item->image }}" alt="Product Image" style="width: auto; height: 250px;">
                    </div>
                    <div class="detail-box">
                        <h4>{{ $item->nama_produk }}</h4>
                        <p>{{ $item->deskripsi }}</p>
                        <p>{{ $item->harga }}</p>
                        <p>{{ $item->id }}</p>
                        <button class="btn btn-primary add-to-cart-btn" data-id="{{ $item->id }}">Add to Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="toppingModal" tabindex="-1" aria-labelledby="toppingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="toppingModalLabel">Pilih Topping</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="cartForm" method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">

                    <div class="form-group">
                        <label>Pilih Topping (Maksimal 3):</label><br>

                        <!-- Toppings tipe makanan -->
                        <p class="my-2">Makanan</p>
                        @foreach ($toppings as $topping)
                            @if ($topping->tipe == 'makanan' && $topping->status == 'tersedia')
                                <div class="form-check">
                                    <input class="form-check-input topping-checkbox" type="checkbox" name="toppings[]" value="{{ $topping->id }}" id="topping{{ $topping->id }}">
                                    <label class="form-check-label" for="topping{{ $topping->id }}">
                                        {{ $topping->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <!-- Toppings tipe minuman -->
                        <p class="my-2">Minuman</p>
                        @foreach ($toppings as $topping)
                            @if ($topping->tipe == 'minuman' && $topping->status == 'tersedia')
                                <div class="form-check">
                                    <input class="form-check-input topping-checkbox" type="checkbox" name="toppings[]" value="{{ $topping->id }}" id="topping{{ $topping->id }}">
                                    <label class="form-check-label" for="topping{{ $topping->id }}">
                                        {{ $topping->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        var productId;

        $('.add-to-cart-btn').on('click', function() {
            productId = $(this).data('id');
            console.log(productId);
            $('#product_id').val(productId);
            $('#toppingModal').modal('show');
        });

        $('.topping-checkbox').on('change', function() {
            if ($('.topping-checkbox:checked').length > 3) {
                alert('Anda hanya bisa memilih maksimal 3 topping.');
                $(this).prop('checked', false);
            }
        });

        // $('#cartForm').on('submit', function(event) {
        //     if ($('.topping-checkbox:checked').length <= 3) {
        //         var actionUrl = '/cart/add/' + productId;
        //         $(this).attr('action', actionUrl);
        //     } else {
        //         alert('Anda hanya bisa memilih maksimal 3 topping.');
        //         event.preventDefault();
        //     }
        // });
    });
</script>

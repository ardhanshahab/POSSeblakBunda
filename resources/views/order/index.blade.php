@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                {{-- <a href="#" class="btn btn-md click-primary mx-4" data-bs-toggle="modal" data-bs-target="#modalTambahMeja" data-placement="top" title="Tambah meja">Data Meja</a> --}}
            </div>
            <div class="card m-4" id="peserta">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Transaksi Order') }}</h3>
                    <table class="table table-striped" id="pesertatable">
                        <thead>
                          <tr>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Nomor Meja</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Spinner -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="spinnerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader"></div>
                        <div clas="loader-txt">
                            <p>Mohon Tunggu..</p>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Order Detail -->
    <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailModalLabel">Order Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody id="orderDetailBody">
                            <!-- Details will be injected here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .loader {
    position: relative;
    text-align: center;
    margin: 15px auto 35px auto;
    z-index: 9999;
    display: block;
    width: 80px;
    height: 80px;
    border: 10px solid rgba(0, 0, 0, .3);
    border-radius: 50%;
    border-top-color: #000;
    animation: spin 1s ease-in-out infinite;
    -webkit-animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
    to {
        -webkit-transform: rotate(360deg);
    }
    }

    @-webkit-keyframes spin {
    to {
        -webkit-transform: rotate(360deg);
    }
    }
    .modal-content {
    border-radius: 0px;
    box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
    }

    .modal-backdrop.show {
    opacity: 0.75;
    }

    .loader-txt {
    p {
        font-size: 13px;
        color: #666;
        small {
        font-size: 11.5px;
        color: #999;
        }
    }
    }
</style>
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
$(document).ready(function(){
    var table = $('#pesertatable').DataTable({
        "processing": true,
        "ajax": {
            "url": "{{ route('getOrder') }}", // URL API untuk mengambil data
            "type": "GET",
        },
        "columns": [
            {"data": "invoice_number"},
            {"data": "no_meja"},
            {"data": "amount"},
        ],
    });

    $('#pesertatable tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        var invoiceNumber = data.invoice_number;

        // Tampilkan modal loading
        // $('#loadingModal').modal('show');

        // Ambil detail order
        $.ajax({
            url: "{{ url('/order/detail') }}/" + invoiceNumber, // Sesuaikan URL API untuk mendapatkan detail order
            type: 'GET',
            success: function(response) {
                // $('#loadingModal').modal('hide');

                // Kosongkan detail order sebelumnya
                $('#orderDetailBody').empty();

                // Tambahkan detail order baru
                response.forEach(function(item) {
                    $('#orderDetailBody').append(`
                        <tr>
                            <td>${item.produk.nama_produk}</td>
                            <td>${item.quantity}</td>
                            <td>${item.produk.harga}</td>
                        </tr>
                    `);
                });

                // Tampilkan modal detail order
                $('#orderDetailModal').modal('show');
            },
            error: function() {
                // $('#loadingModal').modal('hide');
                alert('Gagal mengambil detail order');
            }
        });
    });
});
</script>
@endpush
@endsection

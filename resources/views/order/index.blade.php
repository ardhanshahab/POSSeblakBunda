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

    <div class="modal fade" id="modalTambahMeja" tabindex="-1" role="dialog" aria-labelledby="modalTambahMejaTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahMejaTitle">Tambah Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form tambah kategori produk di sini -->
                    <form action="{{ route('meja.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="no_meja">Nomor Meja</label>
                            <input type="text" class="form-control" id="no_meja" name="no_meja" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditMeja" tabindex="-1" role="dialog" aria-labelledby="modalEditMejaTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMejaTitle">Edit Status Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form Edit kategori produk di sini -->
                    <form id="formEditmeja" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" name="id_meja" id="id_meja" value="">
                            <label for="status_edit">Status Meja</label>
                            <select name="status_edit" id="status_edit" class="form-select">
                                <option value="Terisi">Terisi</option>
                                <option value="Kosong">Kosong</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="updateKategori()">Simpan</button>
                    </form>
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
    function updateKategori() {
        var id = $('#id_meja').val();
        var status = $('#status_edit').val();

        $.ajax({
            url: "{{ route('meja.update', ':id') }}".replace(':id', id),
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                console.log(response);
                $('#modalEditMeja').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function openEditModal(id, status) {
        $('#status_edit').val(status);
        $('#id_meja').val(id);
        // Mengubah atribut action pada form untuk menyimpan perubahan pada kategori dengan id tertentu
        // $('#formEditmeja').attr('action', '/meja/' + id);

        // Menampilkan modal edit kategori
        $('#modalEditMeja').modal('show');
    }


$(document).ready(function(){
    $('#pesertatable').DataTable({
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


});

</script>
@endpush
@endsection

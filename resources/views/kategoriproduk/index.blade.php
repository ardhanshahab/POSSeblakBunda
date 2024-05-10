@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-md click-primary mx-4" data-toggle="modal" data-target="#modalTambahKategori" data-placement="top" title="Tambah kategori produk">Data Kategori Produk</a>
            </div>
            <div class="card m-4" id="peserta">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Kategori Produk') }}</h3>
                    <table class="table table-striped" id="pesertatable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
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

    <div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="modalTambahKategoriTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKategoriTitle">Tambah Kategori Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form tambah kategori produk di sini -->
                    <form action="{{ route('kategoriproduk.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditKategori" tabindex="-1" role="dialog" aria-labelledby="modalEditKategoriTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditKategoriTitle">Edit Kategori Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form Edit kategori produk di sini -->
                    <form id="formEditKategori" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" name="id_kategori_produk" id="id_kategori_produk" value="">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori_edit" name="nama_kategori" required>
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
        var id = $('#id_kategori_produk').val();
        var nama_kategori = $('#nama_kategori_edit').val();

        $.ajax({
            url: "{{ route('kategoriproduks.update', ':id') }}".replace(':id', id),
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                nama_kategori: nama_kategori
            },
            success: function(response) {
                console.log(response);
                $('#modalEditKategori').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }


function openEditModal(id, nama_kategori) {
    $('#nama_kategori_edit').val(nama_kategori);
    $('#id_kategori_produk').val(id);
    // Mengubah atribut action pada form untuk menyimpan perubahan pada kategori dengan id tertentu
    $('#formEditKategori').attr('action', '/kategoriproduk/' + id);

    // Menampilkan modal edit kategori
    $('#modalEditKategori').modal('show');
}

$(document).ready(function(){
    $('#pesertatable').DataTable({
        "processing": true,
        "ajax": {
            "url": "{{ route('getKategoriProduk') }}", // URL API untuk mengambil data
            "type": "GET",
        },
        "columns": [
            {"data": "id"},
            {"data": "nama_kategori"},
            {
                "data": null,
                "render": function(data, type, row) {
                    var actions = ''
                    actions += '<div class="dropdown">';
                    actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                    actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    actions += '<a class="dropdown-item" href="#" onclick="openEditModal(' + row.id + ', \'' + row.nama_kategori + '\')">Edit</a>';
                    actions += '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="/kategoriproduk/' + row.id + '" method="POST">';
                    actions += '<input type="hidden" name="_method" value="DELETE">';
                    actions += '<input type="hidden" name="_token" value="' + '{{ csrf_token() }}' + '">';
                    actions += '<button type="submit" class="dropdown-item">Hapus</button>';
                    actions += '</form>';
                    actions += '</div>';
                    actions += '</div>';
                    return actions;
                }
            }
        ],
    });


});

</script>
@endpush
@endsection

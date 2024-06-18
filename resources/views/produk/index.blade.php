@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <a id="btn-tambah-produk" href="#" class="btn btn-md click-primary mx-4" data-toggle="modal" data-target="#modalTambahProduk" data-placement="top" title="Tambah kategori produk">Data Produk</a>
            </div>
            <div class="card m-4" id="peserta">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Produk') }}</h3>
                    <table class="table table-striped" id="produktable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kategori Produk</th>
                            <th scope="col">Deskripsi</th>
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

    <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahProdukTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahProdukTitle">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form tambah kategori produk di sini -->
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_produk">Kategori Produk</label>
                            <select name="kategori_produk" id="kategori_produk" class="form-control">
                                <option selected>Pilih Kategori Menu</option>
                                @foreach ($posts as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Foto Produk</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="modalEditProdukTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditProdukTitle">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form Edit kategori produk di sini -->
                    <form action="{{ route('updateProduk') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" name="id_produk" id="id_produk">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk_edit" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_produk_edit">Kategori Produk</label>
                            <select name="kategori_produk_edit" id="kategori_produk_edit" class="form-control">
                                <option selected disabled>Pilih Kategori Menu</option>
                                @foreach ($posts as $post)
                                    <option value="{{ $post->nama_kategori }}">{{ $post->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_edit">Harga</label>
                            <input type="text" class="form-control" id="harga_edit" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_edit">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi_edit" name="deskripsi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

    // Fungsi untuk membuka modal tambah produk
    function openTambahProdukModal() {
        $('#modalTambahProduk').modal('show');
    }

    // Fungsi untuk menutup modal tambah produk
    function closeTambahProdukModal() {
        $('#modalTambahProduk').modal('hide');
    }

    // Event click pada tombol "Data Produk" untuk membuka modal tambah produk
    $('#btn-tambah-produk').click(function(e) {
        e.preventDefault(); // Menghentikan default action dari link
        openTambahProdukModal(); // Memanggil fungsi untuk membuka modal tambah produk
    });



    function updateProduk() {
        var id = $('#id_produk').val();
        var nama_produk = $('#nama_produk_edit').val();
        var kategori_produk = $('#kategori_produk_edit').val();
        var harga = $('#harga_edit').val();
        var deskripsi = $('#deskripsi_edit').val();

        $.ajax({
            url: "{{ url('/master/produk') }}/" + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                nama_produk: nama_produk,
                kategori_produk: kategori_produk,
                harga: harga,
                deskripsi: deskripsi
            },
            success: function(response) {
                console.log(response);
                $('#modalEditProduk').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function openEditModal(id, nama_produk, kategori_produk, harga, deskripsi) {
        $('#id_produk').val(id);
        $('#nama_produk_edit').val(nama_produk);
        $('#kategori_produk_edit').val(kategori_produk);
        $('#harga_edit').val(harga);
        $('#deskripsi_edit').val(deskripsi);

        // Menampilkan modal edit produk
        $('#modalEditProduk').modal('show');
    }


    $(document).ready(function(){
        $('#produktable').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('getProduk') }}", // URL API untuk mengambil data
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
                {
                    "data": "image",
                    "render": function (data, type, row) {
                        return '<img src="/storage/posts/' + data + '" alt="Product Image" style="max-width: 100px; max-height: 100px;">';
                    }
                },
                {"data": "nama_produk"},
                {"data": "harga"},
                {"data": "kategori_produk"},
                {"data": "deskripsi"},
                {
                    "data": null,
                    "render": function(data, type, row) {
                        var actions = ''
                        actions += '<div class="dropdown">';
                        actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                        actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        actions += '<a class="dropdown-item" href="#" onclick="openEditModal(' + row.id + ', \'' + row.nama_produk + '\', \'' + row.kategori_produk + '\', \'' + row.harga + '\', \'' + row.deskripsi + '\')">Edit</a>';
                        actions += '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="/master/produk/' + row.id + '" method="POST">';
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

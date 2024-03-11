@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <button type="button" class="btn btn-md btn-success mb-3" data-toggle="modal"
                            data-target="#modalTambahData"><i class="fa fa-plus fa-fw"></i> Tambah Data Makanan</button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Foto Makanan</th>
                                    <th scope="col">Nama Makanan</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/posts/' . $post->foto) }}" class="rounded"
                                                style="width: 150px">
                                        </td>
                                        <td>{{ $post->nama_makanan }}</td>
                                        <td>{!! $post->keterangan !!}</td>
                                        <td>{{ $post->harga }}</td>
                                        <td>{{ $post->stok }}</td>
                                        <td>
                                            @if ($post->status == 'Ada')
                                                <span class="badge badge-success">Tersedia</span>
                                            @elseif ($post->status == 'Kosong')
                                                <span class="badge badge-danger">Kosong</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('makanan.destroy', $post->id) }}" method="POST">
                                                {{-- <a href="{{ route('makanan.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a> --}}
                                                <button type="button" class="btn btn-sm btn-primary mb-3"
                                                    data-toggle="modal" data-target="#modalShowData"
                                                    data-id="{{ $post->id }}">Show</button>
                                                <button type="button" class="btn btn-sm btn-warning mb-3"
                                                    data-toggle="modal" data-target="#modalEditData"
                                                    data-id="{{ $post->id }}">Edit</button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mb-3">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Post belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal tambah data -->
        <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="tambahdata" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahdata">Tambah Data Makanan</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                                class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('makanan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Foto Makanan</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto">
                                @error('foto')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Makanan</label>
                                <input type="text" class="form-control @error('nama_makanan') is-invalid @enderror"
                                    name="nama_makanan" value="{{ old('nama_makanan') }}"
                                    placeholder="Masukkan Nama Makanan">
                                @error('nama_makanan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="5"
                                    placeholder="Masukkan Konten Post">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" value="{{ old('harga') }}" placeholder="Masukkan Nama Makanan">
                                @error('harga')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal show data -->
        <div class="modal fade" id="modalShowData" tabindex="-1" aria-labelledby="showdata" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showdata">Detail Makanan</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                                class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tambahkan elemen ini untuk menampilkan detail makanan -->
                        <img id="detailFotoMakanan" src="" class="rounded" style="width: 150px">
                        <p id="detailNamaMakanan"></p>
                        <p id="detailKeterangan"></p>
                        <p id="detailHarga"></p>
                        <p id="detailStok"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalEditLabel">Edit Data Makanan</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditData" action="" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Makanan</label>
                                <input id="editNamaMakanan" type="text"
                                    class="form-control @error('nama_makanan') is-invalid @enderror" name="nama_makanan"
                                    placeholder="Masukkan Nama Makanan">
                                @error('nama_makanan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea id="editKeterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                    rows="5" placeholder="Masukkan Konten Post"></textarea>
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input id="editHarga" type="text"
                                    class="form-control @error('harga') is-invalid @enderror" name="harga"
                                    placeholder="Masukkan Nama Makanan">
                                @error('harga')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Stok</label>
                                <input id="editStok" type="text"
                                    class="form-control @error('stok') is-invalid @enderror" name="stok"
                                    placeholder="Masukkan Stok">
                                @error('stok')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                {{-- <input id="editstatus" type="text" class="form-control @error('status') is-invalid @enderror" name="status" placeholder="Masukkan status"> --}}
                                <select id="editstatus" class="form-control @error('status') is-invalid @enderror"
                                    name="status">
                                    <option>Masukan Status</option>
                                    <option value="Ada">Ada</option>
                                    <option value="Kosong">Kosong</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button id="btnSimpanEdit" type="button" class="btn btn-md btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalShowData').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang mengakibatkan modal ini terbuka
                var idMakanan = button.data('id'); // Mengambil nilai dari atribut data-id

                // Lakukan request ke server untuk mengambil data makanan dengan ID yang sesuai
                $.ajax({
                    url: '/makanan/' + idMakanan,
                    type: 'GET',
                    success: function(response) {
                        var makanan = response.data;
                        // Tampilkan data makanan di modal
                        $('#detailFotoMakanan').attr('src', '/storage/posts/' + makanan.foto);
                        $('#detailNamaMakanan').text('Nama Makanan: ' + makanan.nama_makanan);
                        $('#detailKeterangan').text('Keterangan: ' + makanan.keterangan);
                        $('#detailHarga').text('Harga: ' + makanan.harga);
                        $('#detailStok').text('Stok: ' + makanan.stok);
                    }
                });
            });

            $('#modalEditData').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang mengakibatkan modal ini terbuka
                var idMakanan = button.data('id'); // Mengambil nilai dari atribut data-id

                // Lakukan request ke server untuk mengambil data makanan dengan ID yang sesuai
                $.ajax({
                    url: '/makanan/' + idMakanan,
                    type: 'GET',
                    success: function(response) {
                        var makanan = response.data;
                        // Isi form edit dengan data makanan
                        $('#editNamaMakanan').val(makanan.nama_makanan);
                        $('#editKeterangan').val(makanan.keterangan);
                        $('#editHarga').val(makanan.harga);
                        $('#editStok').val(makanan.stok);

                        // Set action form edit ke URL update makanan yang sesuai
                        $('#formEditData').attr('action', '/makanan/' + idMakanan);
                    }
                });
            });

            // Handle klik tombol Simpan pada modal edit data
            $('#btnSimpanEdit').on('click', function() {
                // Submit form edit data
                $('#formEditData').submit();
            });
        });
    </script>
@endpush

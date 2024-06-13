@extends('layouts.kasir')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <h5>Hi,{{ auth()->user()->name }}</h5> --}}
                            <span>{{ Date('D,d F Y') }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <p class="mx-2">No Meja</p>
                                <select name="no_meja" id="no_meja" class="form-select">
                                    <option value="" selected>Pilih Meja</option>
                                    @foreach ($meja as $post)
                                        <option value="{{ $post->no_meja }}">{{ $post->no_meja }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-warning p-2" >
                <div class="row mb-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-warning" data-filter="all">Semua</button>
                        @foreach ($data['category'] as $category)
                            <button type="button" class="btn btn-warning"
                                data-filter=".{{ $category->nama_kategori }}">{{ $category->nama_kategori }}</button>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row" data-ref="mixitup-container" id="daftar-produk">
                    @foreach ($data['product'] as $product)
                        <div class="col-md-3 mix {{ $product->kategori_produk }}" data-ref="mixitup-target">
                            <div class="card shadow">
                                <div class="card-body p-2">
                                    <img src="/storage/posts/{{ $product->image }}" alt="" srcset=""
                                        class="w-100 rounded" style="height: 160px;object-fit:cover">
                                    <h6 class="mt-2" style="color: #1f1f1f">{{ $product->nama_produk }}</h6>
                                    <h5 class="text-warning">{{ $product->harga }}</h5>
                                    <a href="javascript:;" id="add-btn-{{ $product->id }}" data-id="{{ $product->id }}" data-name="{{ $product->nama_produk }}" data-image="{{ $product->image }}"  data-price="{{ $product->harga }}" class="btn btn-sm btn-block btn-warning btn-add">TAMBAH</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-warning mb-3" style="height: 400px;">
                <div class="card-header">
                    <h3 class="card-title">Rincian Pesanan</h3>
                </div>
                <div class="card-body py-4" id="list-detail">
                    <div class="row" id="daftar-pesanan">

                    </div>
                </div>
            </div>
            <div class="card card-warning">
               <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6>Subtotal</h6>
                    <h6 id="subtotal">0</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6>PPN (10%)</h6>
                    <h6 id="ppn">0</h6>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <h6 id="total">0</h6>
                </div>
                <div class="text-right">
                    <button class="btn btn-warning btn-proses-pembayaran" type="button">Proses Pembayaran</button>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .aktif {
            box-shadow: 0 2px 6px #ffffff;
            background-color: #ffffff;
            border-color: #ffa426;
            color: #ffa426;
        }

        .posisi-relative {
            position: relative;
        }

        .posisi-top-kanan {
            position: absolute;
            top: 0;
            right: 0
        }

        .posisi-bottom-kiri {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 95px
        }

        .gambar-detail {
            height: 65px;
            width: 65px;
            object-fit: cover;
            float: left;
            margin-right: 5px
        }

        .judul-detail {
            color: #1f1f1f;
            font-weight: 700;
            font-size: 18px
        }

        .harga-detail {
            font-weight: bold;
            font-size: 16px;
            position: absolute;
            bottom: 0;
        }
    </style>
@endpush
@push('js')
    {{-- <script src="{{ asset('mixitup/mixitup.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.js" integrity="sha512-fuxK9KrfYYxsXOm+VTYLEX3vOKymX2CDP+X1q0vsTwe9LPyJBSC3LXPu79ZNZiNCFrSzzMklmp5bU9Da/1TQEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js" integrity="sha512-nKZDK+ztK6Ug+2B6DZx+QtgeyAmo9YThZob8O3xgjqhw2IVQdAITFasl/jqbyDwclMkLXFOZRiytnUrXk/PM6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            });
         $("#list-detail").css({
            height: 300,
        }).niceScroll();
        $("#daftar-produk").css({
            height: 400,
        }).niceScroll();
        var containerEl = document.querySelector('[data-ref~="mixitup-container"]');

        var mixer = mixitup(containerEl, {
            selectors: {
                target: '[data-ref~="mixitup-target"]'
            }
        });
        var arrayId = [];
        var total = 0;
        $(document).on('click', '[id^=add-btn-]', function() {
            var product_id = $(this).data('id');
            var name = $(this).data('name');
            var image = $(this).data('image');
            var price = $(this).data('price');
            var id = 'id-' + $(this).data('id');
            let hasKey = arrayId.includes(id);
            console.log(name);
            var content = `
                <div class="col-12 posisi-relative mb-3 ${id}" id="${id}">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <img src="/storage/posts/${image}" alt="" srcset=""
                        class="rounded gambar-detail">
                    <input type="hidden" name="product_id" value="${product_id}">
                    <span class="mt-2 text-bold judul-detail">${name} </span> <br>
                    <span class="text-warning harga-detail">${price}</span>
                    <button type="button" onclick="hapus('${id}')" class="btn btn-danger btn-sm px-2 posisi-top-kanan" ><i class="fa fa-times"></i></button>
                    <div class="input-group posisi-bottom-kiri">
                        <div class="input-group-prepend">
                            <button class="btn btn-warning btn-sm shadow-none btn-minus" type="button">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control form-control-sm jumlah" placeholder="" aria-label=""
                            value="1" style="text-align: center" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-warning btn-sm shadow-none btn-plus" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            if (!hasKey) {
                arrayId.push(id);
                $('#daftar-pesanan').append(content);
                total += price;
                updateTotal(); // Panggil updateTotal() setelah penambahan item
            }
        });


        // Ganti selector ke ID yang sesuai
        // $(document).on('click', '[id^=add-btn-]', function() {
        //     $(this).trigger('click');
        // });


        $(document).on('click', '.btn-plus', function() {
            var inputJumlah = $(this).closest('.input-group').find('.jumlah');
            var jumlah = parseInt(inputJumlah.val());
            var harga = parseInt($(this).closest('.input-group').siblings('.harga-detail').text().replace(/[^\d]/g, ''));
            var totalItem = jumlah * harga;
            inputJumlah.val(jumlah + 1);
            var id = $(this).closest('.posisi-relative').attr('class').split(' ')[2];
            total += harga;
            updateTotal();
        });

        $(document).on('click', '.btn-minus', function() {
            var inputJumlah = $(this).closest('.input-group').find('.jumlah');
            var jumlah = parseInt(inputJumlah.val());
            var harga = parseInt($(this).closest('.input-group').siblings('.harga-detail').text().replace(/[^\d]/g, ''));
            var totalItem = jumlah * harga;
            if (jumlah > 1) {
                inputJumlah.val(jumlah - 1);
                var id = $(this).closest('.posisi-relative').attr('class').split(' ')[2];
                total -= harga;
                updateTotal();
            }
        });

        function updateTotal() {
            var ppn = total * 0.1; // Hitung pajak (10% dari total)
            var subtotal = total - ppn; // Hitung subtotal
            $('#subtotal').text(formatRupiah(subtotal.toString())); // Tampilkan subtotal
            $('#ppn').text(formatRupiah(ppn.toString())); // Tampilkan pajak
            $('#total').text(formatRupiah(total.toString())); // Tampilkan total
        }


        function hapus(id) {
            var price = $('.' + id).find('.harga-detail').text(); // Ambil harga dari elemen dengan class id
            $('.' + id).remove(); // Hapus elemen dari daftar pesanan
            var newArray = arrayId.filter(function(f) { return f !== '' + id + '' }); // Filter id yang dihapus
            arrayId = newArray;
            total -= parseInt(price.replace(/[^\d]/g, '')); // Kurangi harga item dari total
            updateTotal(); // Perbarui tampilan total
        }



        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/\./g, '');
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
            }

            function prosesPembayaran() {
                var orders = [];
                $('#daftar-pesanan .posisi-relative').each(function() {
                    var id = $(this).attr('id');
                    var name = $(this).find('.judul-detail').text();
                    var price = parseInt($(this).find('.harga-detail').text().replace(/[^\d]/g, ''));
                    var quantity = parseInt($(this).find('.jumlah').val());
                    var no_meja = $('#no_meja').val()
                    // var product_id = $('#product_id').val();
                    var parts = id.split('-');
                    var idNumber = parts[1];

                    orders.push({ id: id, name: name, price: price, quantity: quantity, no_meja: no_meja, product_id: idNumber });
                });

                // Tambahkan amount dengan nilai total
                var amount = total;

                $.ajax({
                    type: 'POST',
                    url: '{{ route("order.store") }}',
                    data: {
                        orders: orders,
                        amount: amount // Tambahkan amount ke dalam data
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message); // Tampilkan pesan sukses
                        // Reset daftar pesanan atau lakukan aksi lainnya
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Tampilkan error jika terjadi
                    }
                });

                // Simpan data pesanan ke localStorage
                localStorage.setItem('order', JSON.stringify(orders));
            }


            $('.btn-proses-pembayaran').on('click', function() {
                prosesPembayaran();
                // var orders = [];
                // $('#daftar-pesanan .posisi-relative').each(function() {
                //     var id = $(this).attr('class').split(' ')[2];
                //     var name = $(this).find('.judul-detail').text();
                //     var price = parseInt($(this).find('.harga-detail').text().replace(/[^\d]/g, ''));
                //     var quantity = parseInt($(this).find('.jumlah').val());
                //     orders.push({ id: id, name: name, price: price, quantity: quantity });
                // });
                // console.log(orders);
            });
    </script>
@endpush

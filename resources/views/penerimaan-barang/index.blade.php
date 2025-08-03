@extends('layouts.app')
@section('content_title', 'Penerimaan Barang')

@section('content')

    <div class="row">
        <div class="col-12">
            <form action="{{ route('penerimaan-barang.store') }}" method="POST" id="form-penerimaan-barang">
                @csrf
                <div id="data-hidden"></div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-truck"></i> Penerimaan Barang</h4>
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <button type="submit" class="btn btn-dark"> <i class="fas fa-save me-1"></i>
                                    Simpan</button>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="distributor">Distributor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-tie"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="distributor" id="distributor"
                                            value="{{ old('distributor') }}" placeholder="Masukkan nama distributor">
                                    </div>
                                    @error('distributor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="nomor_faktur">Nomor Faktur</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-file-invoice"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="nomor_faktur" id="nomor_faktur"
                                            value="{{ old('nomor_faktur') }}" placeholder="Masukkan nomor faktur">
                                    </div>
                                    @error('nomor_faktur')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tambah Barang</label>
                                    <select name="select2" id="select2" class="form-control select2-purple"></select>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group m">
                                    <label for="">Stok</label>
                                    <input type="text" id="current_stock" class="form-control mr-2" placeholder="Stok"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" name="harga_beli" id="harga_beli"
                                            placeholder="Masukkan harga beli">
                                    </div>
                                </div>

                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <div class="input-group">
                                        <input type="number" id="qty" class="form-control" aria-describedby="btn-add"
                                            placeholder="Qty">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="btn-add"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Detail barang</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm" id="table-product">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Sub Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let selectedProduct = {};
            $('#select2').select2({
                theme: 'bootstrap',
                placeholder: 'Cari Produk',
                ajax: {
                    url: "{{ route('get-data.products') }}",
                    dataType: "json",
                    delay: 250,
                    data: (params) => {
                        return {
                            search: params.term
                        }
                    },
                    processResults: (data) => {
                        data.forEach(item => {
                            selectedProduct[item.id] = item
                        })

                        return {
                            results: data.map((item) => {
                                return {
                                    id: item.id,
                                    text: item.product_name
                                }
                            })
                        }
                    },
                    cache: true,
                },
                minimumInputLength: 4
            })

            $('#select2').on('change', function(e) {
                let id = $(this).val();

                $.ajax({
                    type: "get",
                    url: "{{ route('get-data.product-stock') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#current_stock').val('Stok: ' + response);
                    }
                });
            })

            $('#btn-add').on('click', function() {
                const selectedId = $('#select2').val();
                const qty = $('#qty').val();
                const currentStock = parseInt($('#current_stock').val().replace(/[^\d]/g, ''));
                const harga_beli = $('#harga_beli').val();
                const sub_total = parseInt(harga_beli) * parseInt(qty);

                const product = selectedProduct[selectedId];

                if (!selectedId || !qty) {
                    alert('Harap pilih produk dan tentukan jumlahnya');
                    return;
                }

                if (!product) {
                    alert('Data produk tidak ditemukan');
                    return;
                }

                if (parseInt(qty) > currentStock) {
                    alert('Jumlah barang tidak tersedia');
                    return;
                }

                let exist = false;
                $('#table-product tbody tr').each(function() {
                    const rowProduct = $(this).find("td:first").text();

                    if (rowProduct === product.product_name) {
                        let currentQty = parseInt($(this).find('td:eq(1)').text());
                        let newQty = currentQty + parseInt(qty);

                        $(this).find("td:eq(1)").text(newQty);
                        exist = true;
                        return false;
                    }
                });

                if (!exist) {
                    let row = `
                    <tr data-id=${product.id}>
                        <td>${product.product_name}</td>
                        <td>${qty}</td>
                        <td>${harga_beli}</td>
                        <td>${sub_total}</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-remove">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;


                    $('#table-product tbody').append(row);
                }

                $('#select2').val(null).trigger('change');
                $('#qty').val(null);
                $('#harga_beli').val(null);
                $('#current_stock').val(null);
            });

            $(document).on('click', '.btn-remove', function() {
                $(this).closest('tr').remove();
            });

            $('#form-penerimaan-barang').on('submit', function() {
                $('#data-hidden').html('');

                $('#table-product tbody tr').each(function(index, row) {
                    const namaProduk = $(row).find("td:eq(0)").text();
                    const qty = $(row).find("td:eq(1)").text();
                    const productId = $(row).data('id');
                    const hargaBeli = $(row).find("td:eq(2)").text();
                    const subTotal = $(row).find("td:eq(3)").text();

                    const inputProduk =
                        `<input type="hidden" name="product[${index}][product_name]" value="${namaProduk}" />`;
                    const
                        inputQty =
                        `<input type="hidden" name="product[${index}][qty]" value="${qty}" />`;
                    const
                        inputProductId =
                        `<input type="hidden" name="product[${index}][product_id]" value="${productId}" />`;
                    const
                        inputHargaBeli =
                        `<input type="hidden" name="product[${index}][harga_beli]" value="${hargaBeli}" />`;
                    const
                        inputSubTotal =
                        `<input type="hidden" name="product[${index}][sub_total]" value="${subTotal}" />`;

                    $('#data-hidden').append(inputProduk).append(inputQty).append(inputProductId)
                        .append(inputHargaBeli).append(inputSubTotal);
                })
            })
        });
    </script>
@endpush

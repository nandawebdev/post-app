@extends('layouts.app')

@section('content_title', 'Data Produk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Produk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">

                    <x-alert :errors="$errors" />

                    <div class="d-flex justify-content-end mb-2">
                        <x-product.form-product />
                    </div>
                    <table class="table table-sm table-hover text-nowrap" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SKU</th>
                                <th>Nama Produk</th>
                                <th>Harga Jual</th>
                                <th>Harga Beli</th>
                                <th>Stok</th>
                                <th>Stok Minimum</th>
                                <th>Aktif</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>Rp. {{ number_format($item->purchase_price) }}</td>
                                <td>Rp. {{ number_format($item->product_purchase_price) }}</td>
                                <td>{{ number_format($item->stock) }}</td>
                                <td>{{ $item->minimum_stock }}</td>
                                <td>
                                    <p class="badge badge-{{ $item->is_active ? 'success' : 'danger' }}">
                                        {{ $item->is_active ? 'Aktif' : 'Tidak Aktif'}}
                                    </p>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <x-product.form-product :id="$item->id" />
                                        <a href="{{ route('master-data.product.destroy', $item->id) }}"
                                            data-confirm-delete='true' class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
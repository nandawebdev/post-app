@extends('layouts.app')

@section('content_title', 'Laporan Penerimaan Barang')

@section('content')
    <div class="container my-4">
        <div class="card shadow rounded">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <h4 class="mb-0"><i class="fas fa-globe"></i> PT. POS ID</h4>
                        <small class="text-muted">Laporan Penerimaan Barang</small>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">Tanggal:</small><br>
                        <strong>{{ $data->tanggal_penerimaan }}</strong>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Distributor</h6>
                        <p class="mb-1">{{ $data->distributor }}</p>
                        <p><strong>Nomor Faktur:</strong> {{ $data->nomor_faktur }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Penerima</h6>
                        <p class="mb-0">{{ ucfirst($data->petugas_penerima) }}</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->items as $item)
                                <tr>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-end">Rp {{ number_format($item->harga_beli) }}</td>
                                    <td class="text-end">Rp {{ number_format($item->sub_total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Pembelian</th>
                                <th class="text-end">Rp {{ number_format($data->total) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-between no-print">
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-print"></i> Print
                    </a>
                    <div>
                        <button class="btn btn-primary me-2">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                        <button class="btn btn-success">
                            <i class="far fa-credit-card"></i> Submit Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

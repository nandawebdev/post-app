@extends('layouts.app')

@section('content_title', 'Laporan Penerimaan Barang')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kategori</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-hover text-nowrap" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Penerimaan</th>
                                    <th>Nomor Faktur</th>
                                    <th>Distributor</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Petugas Penerima</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerimaanBarang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomor_penerimaan }}</td>
                                        <td>{{ $item->nomor_faktur }}</td>
                                        <td>{{ $item->distributor }}</td>
                                        <td>{{ $item->tanggal_penerimaan }}</td>
                                        <td>{{ ucwords($item->petugas_penerima) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('laporan.penerimaan-barang.detail-laporan', $item->nomor_penerimaan) }}"
                                                    class="text-primary">
                                                    Detail
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

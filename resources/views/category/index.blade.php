@extends('layouts.app')

@section('content_title', 'Data Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kategori</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">

                    <x-alert :errors="$errors" />

                    <div class="d-flex justify-content-end mb-2">
                        <x-kategori.form-kategori />
                    </div>
                    <table class="table table-sm table-hover text-nowrap" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category_name}}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-kategori.form-kategori :id="$item->id" />
                                        <a href="{{ route('master-data.category.destroy', $item->id) }}"
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
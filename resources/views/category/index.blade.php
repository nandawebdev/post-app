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
                                <td>{{ $item->descripton }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-success">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Tambah Kategori</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input type="text" name="category_name" class="form-control" id="category_name"
                                placeholder="Nama kategori">
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                        </div>

                        <!-- Tombol kanan -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-success mx-2">Simpan</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
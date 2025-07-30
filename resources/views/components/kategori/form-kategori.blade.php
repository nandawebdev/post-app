<div>
    <button type="button" class="btn btn-sm btn-{{ $id ? 'success' : 'primary' }}" data-toggle="modal"
        data-target="#categoryForm{{ $id ?? '' }}">
        <i class="fas fa-{{ $id ? 'edit' : 'plus' }}"></i> {{ $id ? '' : 'Kategori Baru' }}
    </button>

    <div class="modal fade" id="categoryForm{{ $id ?? '' }}">
        <form action="{{ route('master-data.category.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $id ? 'Form Edit Kategori' : 'Form Kategori Baru' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name" id="category_name"
                                value="{{ $category_name }}">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Deskripsi</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ $description }}
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

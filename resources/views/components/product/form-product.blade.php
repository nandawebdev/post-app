<div>
    <button type="button" class="btn btn-sm btn-{{ $id ? 'success' : 'primary' }}" data-toggle="modal"
        data-target="#productForm{{ $id ?? '' }}">
        <i class="fas fa-{{ $id ? 'edit' : 'plus' }}"></i> {{ $id ? '' : 'Product Baru' }}
    </button>

    <div class="modal fade" id="productForm{{ $id ?? '' }}">
        <form action="{{ route('master-data.product.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $id ? 'Form Edit Produk' : 'Form Produk Baru' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                value="{{ $id ? $product_name : old('product_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori Produk</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ $category_id || old('category_id')==$item->id ?
                                    'selected' : ''}}>
                                    {{ $item->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="purchase_price">Harga Jual</label>
                            <input type="number" class="form-control" name="purchase_price" id="purchase_price"
                                value="{{ $id ? $purchase_price : old('purchase_price')}}">
                        </div>

                        <div class="form-group">
                            <label for="product_purchase_price">Harga Beli Produk</label>
                            <input type="number" class="form-control" name="product_purchase_price"
                                id="product_purchase_price"
                                value="{{ $id ? $product_purchase_price : old('product_purchase_price')}}">
                        </div>

                        <div class="form-group">
                            <label for="stock">Stok Persedian</label>
                            <input type="number" class="form-control" name="stock" id="stock"
                                value="{{ $id ? $stock : old('stock')}}">
                        </div>

                        <div class="form-group">
                            <label for="minimum_stock">Stok Minimal</label>
                            <input type="number" class="form-control" name="minimum_stock" id="minimum_stock"
                                value="{{ $id ? $minimum_stock : old('minimum_stock')}}">
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{
                                ($id ? $is_active : old('is_active', $id ? $is_active : false)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktif <small>(Jika aktif produk akan
                                    ditampilkan di halaman kasir)</small></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm  btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
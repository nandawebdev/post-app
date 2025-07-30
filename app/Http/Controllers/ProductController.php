<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product as Model;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

	protected string $viewPath = 'product';
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$model = Model::all();
		confirmDelete('Hapus data', 'Apakah anda yakin ingin menghapus data ini?', 'Hapus', 'Batal');
		return view($this->viewPath . '.index', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreProductRequest $request)
	{
		$validated = $request->validated();

		// Jika ID kosong → berarti store → generate SKU
		$isCreating = empty($validated['id']);

		$data = [
			'product_name' => $validated['product_name'],
			'purchase_price' => $validated['purchase_price'],
			'product_purchase_price' => $validated['product_purchase_price'],
			'stock' => $validated['stock'],
			'minimum_stock' => $validated['minimum_stock'],
			'is_active' => $request->is_active ? true : false,
			'category_id' => $validated['category_id'] ?? null,
		];

		if ($isCreating) {
			$data['sku'] = Model::generateSku();
		}

		Model::updateOrCreate(
			['id' => $validated['id'] ?? null],
			$data
		);

		toast()->success('Berhasil', 'Data berhasil disimpan!');
		return redirect()->route('master-data.product.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id)
	{
		Model::findOrFail($id)->delete();
		toast()->success('Data berhasil dihapus');
		return back();
	}

	public function getData()
	{
		$search = request()->query('search');
		$query = Product::query();
		$product = $query->where('product_name',  'like', '%' . $search . '%')->get();

		return response()->json($product);
	}

	public function checkStock()
	{
		$id = request()->query('id');
		$stock = Product::find($id)->stock;

		return response()->json($stock);
	}
}

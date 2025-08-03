<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaanBarang;
use App\Models\ItemPenerimaanBarang;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PenerimaanBarangController extends Controller
{
	public function index()
	{
		return view('penerimaan-barang.index');
	}

	public function store(Request $request)
	{
		$request->validate([
			'distributor' => 'required',
			'nomor_faktur' => 'required',
			'product' => 'required'
		], [
			'distributor.required' => 'Distributor harus diisi',
			'nomor_faktur.required' => 'Nomor faktur harus diisi',
			'product' => 'Produk harus diisi'
		]);

		$newData = PenerimaanBarang::create([
			'nomor_penerimaan' => PenerimaanBarang::nomorPenerimaan(),
			'distributor' => $request->distributor,
			'nomor_faktur' => $request->nomor_faktur,
			'petugas_penerima' => Auth::user()->name
		]);

		$products = $request->product;

		foreach ($products as $item) {
			ItemPenerimaanBarang::create([
				'nomor_penerimaan' => $newData->nomor_penerimaan,
				'nama_produk' => $item['product_name'],
				'qty' => $item['qty'],
				'harga_beli' => $item['harga_beli'],
				'sub_total' => $item['sub_total'],

				Product::where('id', $item['product_id'])->increment('stock', $item['qty'])
			]);
		}
		toast()->success('Data berhasil ditambahkan', 'Berhasil');
		return back();
	}
}

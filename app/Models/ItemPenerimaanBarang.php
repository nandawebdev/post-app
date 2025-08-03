<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPenerimaanBarang extends Model
{
    protected $fillable = [
			'nomor_penerimaan',
			'nama_produk',
			'qty',
			'harga_beli',
			'sub_total'
		];
}

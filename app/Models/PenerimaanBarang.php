<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanBarang extends Model
{
    protected $fillable = [
			'nomor_penerimaan',
			'distributor',
			'nomor_faktur',
			'petugas_penerima'
		];

		public static function nomorPenerimaan()
		{
			$max = self::max('id');
			$prefix = 'PBR-';
			$date = date('dmy');
			$nomor = $prefix . $date . str_pad($max + 1, 4, '0', STR_PAD_LEFT);

			return $nomor;
		}
}

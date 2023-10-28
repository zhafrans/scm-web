<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProdukMobile extends Model
{
    use HasFactory;
    protected $table = "m_detail_produk";
    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jumlah',
        'harga_jual',
        'status' 
    ];
    public $timestamps = false;
}

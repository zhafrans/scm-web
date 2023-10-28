<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMobileDetail extends Model
{
    use HasFactory;
    protected $table = "m_detail_transaksi";
    protected $fillable = [
        'id_m_transaksi',
        'id_produk',
        'jumlah',        
    ];
    public $timestamps = false;
}

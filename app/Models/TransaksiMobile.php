<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMobile extends Model
{
    use HasFactory;
    protected $table = "m_transaksi";
    protected $fillable = [
        'id_cabang',
        'id_outlet',
        'tanggal',	
        'tipe_payment',	
        'total',
        'status',        
    ];
    public $timestamps = false;
}

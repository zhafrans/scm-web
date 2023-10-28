<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = "sales";
    protected $fillable = [
        'id_depo',
        'nama',              
        'email',              
        'area',              
        'password',              
        'status',              
    ];

}

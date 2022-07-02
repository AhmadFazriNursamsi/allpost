<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPaket extends Model
{
    use HasFactory;
    protected $table = "detail_paket_produk";
    protected $primaryKey = "id";
    protected $guarded = ['id'];
    public $timestamps = false;


}

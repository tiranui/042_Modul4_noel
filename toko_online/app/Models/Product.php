<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id_barang';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_barang', 'nama_barang', 'harga', 'stok', 'gambar', 'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok'  => 'integer',
    ];
}
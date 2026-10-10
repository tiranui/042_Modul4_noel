<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public    $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order', 'id_barang', 'harga_satuan', 'jumlah_beli',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'jumlah_beli'  => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_barang', 'id_barang');
    }
}
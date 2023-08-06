<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id_produk';
    protected $guarded = [
        'id_produk',
    ];


    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(category::class, 'id_category', 'id_category');
    }

    public function cart()
    {
        return $this->hasMany(cart::class, 'id_cart', 'id_cart');
    }

    public function order()
    {
        return $this->hasMany(order::class, 'id_order', 'id_order');
    }

    public function pembelian()
    {
        return $this->hasMany(pembelian::class, 'id_pembelian', 'id_pembelian');
    }
}
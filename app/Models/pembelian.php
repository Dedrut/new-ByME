<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $guarded = [
        'id_pembelian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'id_produk', 'id_produk');
    }

    public function order()
    {
        return $this->belongsTo(order::class, 'id_order', 'id_order');
    }
}

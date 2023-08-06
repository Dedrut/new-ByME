<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $guarded = [
        'id_order',
    ];


    public function product()
    {
        return $this->belongsTo(product::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user', 'id_user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $guarded = [
        'id_category',
    ];

    public $timestamps = false;
    public function product()
    {
        return $this->hasMany(product::class, 'id_produk', 'id_produk');
    }
}
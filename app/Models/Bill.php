<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'BILL';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'product_id',
        'bill_code',
        'expire_date',
        'quantity',
        'price',
        'total_price',
        'status',
        'id_game'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

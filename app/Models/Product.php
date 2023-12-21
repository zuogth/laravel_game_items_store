<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'PRODUCT';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'price',
        'status',
        'total_quantity',
        'category_id',
        'sold'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}

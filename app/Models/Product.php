<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='PRODUCT';
    public $timestamps=false;

    protected $fillable=[
        'name',
        'code',
        'price',
        'status',
        'total_quantity',
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

}

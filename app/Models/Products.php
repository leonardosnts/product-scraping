<?php

namespace App\Models;

use App\Enum\ProductEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Products extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $fillable = [
        'code',
        'barcode',
        'product_name',
        'status',
        'imported_t',
        'url',
        'quantity',
        'categories',
        'packaging',
        'brands',
        'image_url'
    ];

    protected $casts = [
        'imported_t' => 'datetime',
        'status' => ProductEnum::class
    ];

}

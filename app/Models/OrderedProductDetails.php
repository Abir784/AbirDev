<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class OrderedProductDetails extends Model
{
    use HasFactory;
    public function rel_to_products()
    {
      return $this->belongsTo(Products::class, 'product_id');
    }

}

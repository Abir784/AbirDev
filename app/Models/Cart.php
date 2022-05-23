<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];

    function rel_to_products(){
        return $this->belongsTo(Products::class, 'product_id');
    }
}

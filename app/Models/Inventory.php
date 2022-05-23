<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    function rel_products(){
        return $this->belongsTo(Products::class,'product_id');
    }
    function rel_size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    function rel_color(){
        return $this->belongsTo(color::class,'color_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_image',
    ];

    public function rel_to_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function rel_to_subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function rel_to_thumbnails()
    {
        return $this->hasMany(ProductThumbnail::class, 'product_id');
    }
}

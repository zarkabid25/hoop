<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'category_id', 'product_title', 'product_image', 'product_description', 'price_chart'
    ];

    protected $table = 'products';

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

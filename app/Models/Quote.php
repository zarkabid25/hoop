<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'design_name', 'fabric', 'placement', 'format', 'no_color', 'height', 'width', 'image', 'urgent', 'price', 'special_instruct', 'color_type',
        'patch_type', 'shipping_cost', 'tracking_id', 'customer_id', 'order_type'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}

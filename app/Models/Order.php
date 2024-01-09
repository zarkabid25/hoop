<?php

namespace App\Models;

use App\Http\Controllers\Admin\UserManagement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'design_name', 'fabric', 'placement', 'format', 'no_color', 'height', 'width', 'image', 'urgent', 'price', 'special_instruct', 'color_type',
        'patch_type', 'shipping_cost', 'tracking_id', 'customer_id', 'order_type'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function assignDeveloper(){
        return $this->hasOne(AssignOrder::class, 'order_id', 'id');
    }

    public function user(){
        return $this->hasManyThrough(User::class, AssignOrder::class, 'order_id', 'developer_id', 'id', 'id');
    }

    public function assignOrder()
    {
        return $this->hasOne(AssignOrder::class, 'order_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'order_id', 'id');
    }

    public function orderStatus(){
        return $this->hasMany(OrderStatus::class, 'order_id', 'id');
    }
}

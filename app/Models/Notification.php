<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'refered_by', 'status'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}

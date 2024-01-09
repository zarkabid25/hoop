<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'developer_id', 'status', 'development_status', 'order_status'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }
}

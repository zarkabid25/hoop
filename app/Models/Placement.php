<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','bags', 'cap', 'chest', 'gloves', 'cap_side', 'cap_back', 'towel', 'jacketback', 'sleeve', 'patches', 'visor', 'table_cloth', 'beanie_caps', 'apron', 'other'];
}

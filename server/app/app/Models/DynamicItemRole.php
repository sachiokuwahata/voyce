<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicItemRole extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dynamic_item_id',
        'dynamic_item_type'
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'values',
        'dynamic_item_id',
        'demand_group_id'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'required',
        'data_type_id'
    ];

}

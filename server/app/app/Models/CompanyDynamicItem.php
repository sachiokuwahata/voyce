<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDynamicItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'dynamic_item_id',
    ];

}

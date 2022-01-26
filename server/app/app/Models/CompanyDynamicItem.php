<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DynamicItem;

class CompanyDynamicItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'dynamic_item_id',
    ];

    public function dynamicitem()
    {
        return $this->hasOne(DynamicItem::class, 'id', 'dynamic_item_id');
    }

}

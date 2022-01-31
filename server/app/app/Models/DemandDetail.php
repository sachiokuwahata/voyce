<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Demand;
use App\Models\DynamicItem;

class DemandDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'values',
        'dynamic_item_id',
        'demand_group_id',
    ];

    public function demands()
    {
        return $this->belongsTo(Demand::class, 'demand_group_id', 'id');
    }

    public function dynamic_item_label()
    {
        return $this->hasOne(DynamicItem::class, 'id', 'dynamic_item_id');
    }


}

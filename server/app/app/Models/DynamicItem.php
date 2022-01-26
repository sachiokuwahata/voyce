<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DynamicItemChoice;

class DynamicItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'required',
        'data_type_id',
        'company_id',
    ];

    public function choices()
    {
        // return $this->hasMany(DynamicItemChoice::class, 'foreign_key', 'local_key');
        return $this->hasMany(DynamicItemChoice::class, 'dynamic_item_id', 'id');
    }

}

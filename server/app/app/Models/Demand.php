<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DemandDetail;


class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'client_id',
    ];

    public function demand_details()
    {
        return $this->hasMany(DemandDetail::class, 'demand_group_id', 'id');
    }


}

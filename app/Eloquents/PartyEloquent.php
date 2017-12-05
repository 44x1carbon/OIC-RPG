<?php

namespace App\Eloquent;

use App\Eloquents\ProductionIdeaEloquent;
use App\Eloquents\WantedRoleEloquent;
use Illuminate\Database\Eloquent\Model;

class PartyEloquent extends Model
{
    protected $table = 'parties';

    public function productionIdeaEloquent()
    {
        return $this->hasOne(ProductionIdeaEloquent::class, 'party_id');
    }

    public function wantedRoleEloquents()
    {
        return $this->hasMany(WantedRoleEloquent::class, 'party_id');
    }
}

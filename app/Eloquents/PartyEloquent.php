<?php

namespace App\Eloquents;

use App\Domain\Party\Party;
use App\Eloquents\ProductionIdeaEloquent;
use App\Eloquents\WantedRoleEloquent;
use Illuminate\Database\Eloquent\Model;

class PartyEloquent extends Model
{
    protected $table = 'parties';

    public static function fromEntity(Party $party): PartyEloquent
    {
        $model = self::where('party_id', $party->id())->first();
        if(is_null($model)) {
            $model = new static();
            $model->party_id = $party->id();
        }
        $model->active_end_date = $party->activityEndDate()->getIso8601();

        return $model;
    }

    public static function saveDomainObject(Party $party): bool
    {
        $result = self::fromEntity($party)->save();
        $result = ProductionIdeaEloquent::saveDomainObject($party->productionIdea(), $party->id()) ? $result : false;

        foreach ($party->wantedRoles() as $wantedRole) {
            $result = WantedRoleEloquent::saveDomainObject($wantedRole, $party->id()) ? $result : false;
        }

        return $result;
    }

    public function productionIdeaEloquent()
    {
        return $this->hasOne(ProductionIdeaEloquent::class, 'party_id');
    }

    public function wantedRoleEloquents()
    {
        return $this->hasMany(WantedRoleEloquent::class, 'party_id',);
    }
}

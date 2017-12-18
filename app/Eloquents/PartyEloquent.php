<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\ValueObjects\ActivityEndDate;
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
        $model->active_end_date = $party->activityEndDate()->date();
        $model->manager_id = $party->partyManagerId()->code();

        return $model;
    }

    public static function saveDomainObject(Party $party): bool
    {
        $model = self::fromEntity($party);
        $result = $model->save();
        $result = ProductionIdeaEloquent::saveDomainObject($party->productionIdea(), $model) ? $result : false;

        foreach ($party->wantedRoles() as $wantedRole) {
            $result = WantedRoleEloquent::saveDomainObject($wantedRole, $model) ? $result : false;
        }

        return $result;
    }

    public function productionIdeaEloquent()
    {
        return $this->hasOne(ProductionIdeaEloquent::class, 'party_id');
    }

    public function wantedRoleEloquents()
    {
        return $this->hasMany(WantedRoleEloquent::class, 'party_id');
    }

    public function toEntity(): Party
    {
        $productionIdea = $this->productionIdeaEloquent->toEntity();
        $wantedRoles = $this->wantedRoleEloquents->map(function(WantedRoleEloquent $model) {
            return $model->toEntity();
        })->toArray();

        return new Party(
            $this->party_id,
            new ActivityEndDate($this->active_end_date),
            new StudentNumber($this->manager_id),
            $productionIdea,
            $wantedRoles
        );
    }
}

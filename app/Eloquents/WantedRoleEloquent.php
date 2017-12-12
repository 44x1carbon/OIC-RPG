<?php

namespace App\Eloquents;

use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\WantedRole;
use Illuminate\Database\Eloquent\Model;

class WantedRoleEloquent extends Model
{
    protected $table = 'wanted_roles';

    public static function fromEntity(WantedRole $wantedRole)
    {
        $model = self::where('wanted_role_id', $wantedRole->id())->first();
        if(is_null($model)) {
            $model = new static();
            $model->wanted_role_id = $wantedRole->id();
        }

        $model->role_name = $wantedRole->roleName();
        $model->remarks = $wantedRole->remarks();
        $model->reference_job_id = $wantedRole->referenceJobId();

        return $model;
    }

    public static function saveDomainObject(WantedRole $wantedRole, PartyEloquent $parentModel)
    {
        $model = self::fromEntity($wantedRole);
        $model->partyEloquent()->associate($parentModel);
        $result = $model->save();

        foreach ($wantedRole->wantedMemberList()->all() as $wantedMember) {
            $result = WantedMemberEloquent::saveDomainObject($wantedMember, $model)? $result : false;
        }

        return $result;
    }

    public function wantedMemberEloquents()
    {
        return $this->hasMany(WantedMemberEloquent::class, 'wanted_role_id');
    }

    public function partyEloquent()
    {
        return $this->belongsTo(PartyEloquent::class, 'party_id');
    }

    public function toEntity(): WantedRole
    {
        $wantedMembers = $this->wantedMemberEloquents->map(function(WantedMemberEloquent $model) {
           return $model->toEntity();
        })->toArray();

        $entity = new WantedRole(
            $this->wanted_role_id,
            $this->role_name,
            $this->reference_job_id,
            $this->remarks,
            $wantedMembers
        );

        return $entity;
    }
}

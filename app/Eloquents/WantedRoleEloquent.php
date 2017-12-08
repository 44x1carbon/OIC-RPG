<?php

namespace App\Eloquents;

use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\WantedRole;
use Illuminate\Database\Eloquent\Model;

class WantedRoleEloquent extends Model
{
    protected $table = 'wanted_roles';

    public static function fromEntity($wantedRole)
    {
        $model = self::where('wanted_role_id', $wantedRole->id())->first();
        if(is_null($model)) {
            $model = new static();
            $model->wanted_role_id = $wantedRole->id();
        }

        $model->role_name = $wantedRole->name();
        $model->remarks = $wantedRole->remarks();
        $model->reference_job_id = $wantedRole->referenceJobId();

        return $model;
    }

    public static function saveDomainObject(WantedRole $wantedRole, string $id)
    {
        $model = self::fromEntity($wantedRole);
        $model->party_id = $id;
        $result = $model->save();

        foreach ($wantedRole->wantedMemberList()->all() as $wantedMember) {
            $result = WantedMemberEloquent::saveDomainObject($wantedMember, $wantedRole->id())? $result : false;
        }

        return $result;
    }

    public function wantedMemberEloquents()
    {
        return $this->hasMany(WantedMemberEloquent::class, 'wanted_role_id');
    }

    public function toEntity(): WantedRole
    {
        $entity = new WantedRole();
        $entity->setId($this->wanted_role_id);
        $entity->setReferenceJobId($this->reference_job_id);
        $entity->setName($this->role_name);
        $entity->setRemarks($this->remarks);

        return $entity;
    }
}

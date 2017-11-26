<?php

namespace App\Eloquents;

use App\Domain\WantedRole\WantedRole;
use Illuminate\Database\Eloquent\Model;

class WantedRoleEloquent extends Model
{
    protected $table = 'wanted_roles';

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

<?php

namespace App\Infrastracture\WantedRole;

use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Domain\WantedRole\WantedRole;
use App\Eloquents\WantedRoleEloquent;

class WantedRoleEloquentRepositoryImpl implements WantedRoleRepositoryInterface
{
    protected $eloquent;

    function __construct(WantedRoleEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(String $id): ?WantedRole
    {
        return null_safety($this->eloquent->where('wanted_role_id', $id)->first(), function(WantedRoleEloquent $model) {
            return $model->toEntity();
        });
    }

    public function save(WantedRole $wantedRole): bool
    {
        $model = $this->eloquent->where('wanted_role_id', $wantedRole->id())->first();
        if(is_null($model)) {
            $model = new $this->eloquent();
            $model->wanted_role_id = $wantedRole->id();
        }

        $model->role_name = $wantedRole->roleName();
        $model->remarks = $wantedRole->remarks();
        $model->reference_job_id = $wantedRole->referenceJobId();

        return $model->save();
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(WantedRoleEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }
}
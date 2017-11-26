<?php

namespace App\Infrastracture\WantedRole;

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
        
    }

    public function save(WantedRole $wantedMember): bool
    {
        // TODO: Implement save() method.
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}
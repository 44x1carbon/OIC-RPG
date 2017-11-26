<?php

namespace App\Infrastracture\WantedRole;

use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Domain\WantedRole\WantedRole;

class WantedRoleEloquentRepositoryImpl implements WantedRoleRepositoryInterface
{

    public function findById(String $id): ?WantedRole
    {
        // TODO: Implement findById() method.
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
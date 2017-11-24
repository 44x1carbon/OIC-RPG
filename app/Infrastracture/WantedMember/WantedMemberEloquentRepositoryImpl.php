<?php

namespace App\Infrastracture\WantedMember;

use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\WantedMember\WantedMember;
use App\Eloquents\WantedMemberEloquent;

class WantedMemberEloquentRepositoryImpl implements WantedMemberRepositoryInterface
{
    protected $eloquent;

    function __construct(WantedMemberEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(String $id): ?WantedMember
    {
        // TODO: Implement findById() method.
    }

    public function save(WantedMember $wantedMember): bool
    {
        // TODO: Implement save() method.
    }

    public function all(): Array
    {
        // TODO: Implement all() method.
    }
}
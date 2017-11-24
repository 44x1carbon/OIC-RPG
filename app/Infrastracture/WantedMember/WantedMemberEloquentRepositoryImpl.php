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

    public function findById(string $id): ?WantedMember
    {
        return null_safety($this->eloquent->where('wanted_member_id', $id)->first(), function(WantedMemberEloquent $model) {
            return $model->toEntity();
        });
    }

    public function save(WantedMember $wantedMember): bool
    {
        $model = $this->eloquent->where('wanted_member_id', $wantedMember->id())->first();
        if(is_null($model)) {
            $model = new $this->eloquent;
            $model->wanted_member_id = $wantedMember->id();
        }

        $model->wanted_status = $wantedMember->wantedStatus()->status();
        $model->officer_id = $wantedMember->officerId()->code();

        return $model->save();
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}
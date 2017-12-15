<?php

namespace App\Infrastracture\WantedMember;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
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
        $model->officer_id = null_safety($wantedMember->officerId(), function(StudentNumber $officerId) {
            return $officerId->code();
        });

        return $model->save();
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(WantedMemberEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }
}
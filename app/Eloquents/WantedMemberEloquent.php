<?php

namespace App\Eloquents;

use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use Illuminate\Database\Eloquent\Model;

class WantedMemberEloquent extends Model
{
    protected $table = 'wanted_members';

    public function toEntity(): WantedMember
    {
        $entity = new WantedMember();
        $entity->setWantedStatus(new WantedStatus($this->wanted_status));

        return $entity;
    }
}

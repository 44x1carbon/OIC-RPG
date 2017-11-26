<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use Illuminate\Database\Eloquent\Model;

class WantedMemberEloquent extends Model
{
    protected $table = 'wanted_members';

    public function toEntity(): WantedMember
    {
        $entity = new WantedMember();
        $entity->setId($this->wanted_member_id);
        $entity->setWantedStatus(new WantedStatus($this->wanted_status));
        if(!is_null($this->officer_id)) $entity->setOfficerId(new StudentNumber($this->officer_id));

        return $entity;
    }
}

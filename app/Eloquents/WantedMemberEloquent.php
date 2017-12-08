<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use Illuminate\Database\Eloquent\Model;

class WantedMemberEloquent extends Model
{
    protected $table = 'wanted_members';

    public static function fromEntity(WantedMember $wantedMember): WantedMemberEloquent
    {
        $model = self::where('wanted_member_id', $wantedMember->id())->first();
        if(is_null($model)) {
            $model = new static();
            $model->wanted_member_id = $wantedMember->id();
        }

        $model->wanted_status = $wantedMember->wantedStatus()->status();
        $model->officer_id = null_safety($wantedMember->officerId(), function(StudentNumber $officerId) {
            return $officerId->code();
        });

        return $model;
    }

    public static function saveDomainObject(WantedMember $wantedMember, string $id)
    {
        $model = self::fromEntity($wantedMember);
        $model->wanted_member_id = $id;
        return $model->save();
    }

    public function toEntity(): WantedMember
    {
        $entity = new WantedMember();
        $entity->setId($this->wanted_member_id);
        $entity->setWantedStatus(new WantedStatus($this->wanted_status));
        if(!is_null($this->officer_id)) $entity->setOfficerId(new StudentNumber($this->officer_id));

        return $entity;
    }
}

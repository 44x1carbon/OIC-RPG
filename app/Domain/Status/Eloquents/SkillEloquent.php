<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\Skill;
use App\Domain\Status\ValueObject\SkillInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class SkillEloquent extends Model
{
    protected $table = "skills";
    protected $guarded = [];


    function getInfo():SkillInfo
    {
        return new SkillInfo([
            "skillCode" => $this->skill_code,
            "name" => $this->name,
            "memo" => $this->memo,
        ]);
    }

    function toEntity():Skill
    {
        $scope = [
            Skill::SCOPE_INFO => $this->getInfo()
        ];

        return new Skill($this->id, $scope);
    }

    function fromEntity(Skill $skill):SkillEloquent
    {
        return self::find($skill->getId());
    }
}

<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\RequiredSkill;
use App\Domain\Status\ValueObject\RequiredSkillInfo;
use Illuminate\Database\Eloquent\Model;

class RequiredSkillEloquent extends Model
{
    protected $table = "required_skills";
    protected $guarded = [];

    public function skill()
    {
        return $this->belongsTo(SkillEloquent::class, "skill_id");
    }

    public function toValueObject():RequiredSkillInfo
    {
        return new RequiredSkillInfo([
            "skillCode" => $this->skill->skill_code,
            "name" => $this->skill->name,
            "memo" =>  $this->skill->memo,
            "requiredLevel" => $this->required_level,
        ]);
    }

    public function toEntity():RequiredSkill
    {
        $scope = [
            RequiredSkill::SCOPE_INFO => $this->toValueObject()
        ];

        return new RequiredSkill($this->id, $scope);
    }

}

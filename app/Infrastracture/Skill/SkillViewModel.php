<?php

namespace App\Infrastracture\Job;


use App\Domain\Skill\Skill;

class SkillViewModel
{

    /**
     * SkillViewModel constructor.
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        $this->id = $skill->skillId();
        $this->name = $skill->skillName();
    }
}

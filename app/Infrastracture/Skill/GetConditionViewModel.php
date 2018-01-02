<?php

namespace App\Infrastracture\Job;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;

class GetConditionViewModel
{
    private $getCondition;
    private $skill = null;

    /**
     * GetConditionViewModel constructor.
     * @param GetCondition $getCondition
     */
    public function __construct(GetCondition $getCondition)
    {
        $this->getCondition = $getCondition;
        /* @var SkillRepositoryInterface $skillRepo */
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->requiredLevel = $getCondition->requiredLevel();
    }

    /**
     * @return SkillViewModel
     */
    public function skill(): SkillViewModel
    {
        $this->skill = $this->skill ?? new SkillViewModel($this->skillRepo->findBySkillId($this->getCondition->skillId()));
        return $this->skill;
    }
}

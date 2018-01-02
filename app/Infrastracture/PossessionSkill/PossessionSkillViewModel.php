<?php

namespace App\Infrastracture\PossessionSkill;


use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Infrastracture\Job\SkillViewModel;

class PossessionSkillViewModel
{
    private $possessionSkill;
    /* @var SkillRepositoryInterface $skillRepo */
    private $skillRepo;
    private $skill = null;

    /**
     * PossessionSkillViewModel constructor.
     * @param PossessionSkill $possessionSkill
     */
    public function __construct(PossessionSkill $possessionSkill)
    {
        $this->possessionSkill = $possessionSkill;
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->totalExp = $possessionSkill->totalExp();
        $this->skillLevel = $possessionSkill->skillLevel();
    }

    /**
     * @return SkillViewModel
     */
    public function skill(): SkillViewModel
    {
        if(is_null($this->skill)) {
            $skill = $this->skillRepo->findById($this->possessionSkill->skillId());
            $this->skill = new SkillViewModel($skill);
        }

        return $this->skill;
    }

    /**
     * @return int
     */
    public function nextExp(): int
    {
        $nextTotalExp = ($this->skillLevel + 1) * PossessionSkill::LEVEL_UP_INTERVAL;
        return $nextTotalExp - $this->totalExp;
    }
}

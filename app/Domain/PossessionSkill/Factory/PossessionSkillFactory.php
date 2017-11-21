<?php

namespace App\Domain\PossessionSkill\Factory;

use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\DomainUtility\RandomStringGenerator;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 14:20
 */

class PossessionSkillFactory
{
    protected $repo;

    public function __construct()
    {
        $this->repo = app(PossessionSkillRepositoryInterface::class);
    }

    public function createPossessionSkill(Skill $skill): PossessionSkill
    {
        $possessionSkill = new PossessionSkill();
        $possessionSkill->setId($this->makePossessionSkillId());
        $possessionSkill->setSkill($skill);
        $possessionSkill->setSkillLevel(1);
        $possessionSkill->setTotalExp(0);
        return $possessionSkill;
    }

    public function makePossessionSkillId(): String
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null($this->repo->findById($randId)));

        return $randId;
    }
}
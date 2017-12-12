<?php

namespace App\Domain\PossessionSkill\Service;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\AddProcess;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Spec\AddProcessSpec;
use App\Domain\Skill\Skill;
use App\Exceptions\DomainException;
use App\Infrastracture\PossessionSkill\PossessionSkillOnMemoryRepositoryImpl;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:42
 */

class PossessionSkillDomainService
{
    const LEVEL_UP_INTERVAL = 100;

    protected $possessionSkillRepo;

    public function __construct(PossessionSkillRepositoryInterface $repo)
    {
        $this->possessionSkillRepo = $repo;
    }

    public function addService(PossessionSkill $possessionSkill, int $exp): bool
    {
        $addResultPossessionSkill = self::AddExp($possessionSkill, $exp);
        $addResultPossessionSkill = self::levelUp($possessionSkill, $addResultPossessionSkill);

        return $this->possessionSkillRepo->save($addResultPossessionSkill);
    }

    public function checkPossessionSKill(Skill $skill): PossessionSkill
    {
        $possessionSkill = $this->possessionSkillRepo->findBySkill($skill);
        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->createPossessionSkill($skill);
        }
        return $possessionSkill;
    }

    public static function addExp(PossessionSkill $beforePossessionSkill, int $exp): PossessionSkill
    {
        $afterPossessionSkill = $beforePossessionSkill->clone();
        $afterPossessionSkill->setTotalExp($beforePossessionSkill->totalExp() + $exp);

        return $afterPossessionSkill;
    }

    public static function levelUp(PossessionSkill $beforePossessionSkill, PossessionSkill $afterPossessionSkill): PossessionSkill
    {
        $beforeTotalExp = $beforePossessionSkill->totalExp();
        $afterTotalExp = $afterPossessionSkill->totalExp();

        $exp = $afterTotalExp - $beforeTotalExp;

        $levelUpValue = (int) floor(($beforeTotalExp % self::LEVEL_UP_INTERVAL + $exp) / self::LEVEL_UP_INTERVAL);
        $afterPossessionSkill->setSkillLevel($afterPossessionSkill->skillLevel() + $levelUpValue);

        return $afterPossessionSkill;
    }
}
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
    protected $possessionSkillRepo;

    public function __construct(PossessionSkillRepositoryInterface $repo)
    {
        $this->possessionSkillRepo = $repo;
    }

    public function addExpService(PossessionSkill $possessionSkill, int $exp): bool
    {
        $addResultPossessionSkill = self::AddExp($possessionSkill, $exp);
        $addResultPossessionSkill = PossessionSkill::levelUp($possessionSkill, $addResultPossessionSkill);

        return $this->possessionSkillRepo->save($addResultPossessionSkill, $possessionSkill->studentNumber());
    }

    public static function addExp(PossessionSkill $beforePossessionSkill, int $exp): PossessionSkill
    {
        $afterPossessionSkill = $beforePossessionSkill->clone();
        $afterPossessionSkill->setTotalExp($beforePossessionSkill->totalExp() + $exp);

        return $afterPossessionSkill;
    }
}
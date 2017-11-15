<?php

namespace App\Domain\PossessionSkill\Service;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\AddProcess;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Spec\AddProcessSpec;
use App\Domain\Skill\Skill;
use App\Exceptions\DomainException;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:42
 */

class PossessionSkillDomainService
{
    protected $possessionSkillRepo;

    public function __construct()
    {
    }

    public function addService(StudentNumber $studentNumber,Skill $skill,int $exp): bool
    {
        if(!GuildMemberSpec::isExistStudentNumber($studentNumber)) return false;

        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
        $possessionSkill = $this->possessionSkillRepo->findBySkill($skill);
        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->possessSkill($skill);
        }

        $addResultPossessionSkill = AddProcess::AddExp($possessionSkill, $exp);

        return $this->possessionSkillRepo->save($addResultPossessionSkill);
    }
}
<?php

namespace App\Domain\PossessionSkill\Service;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Spec\AddProcessSpec;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:42
 */

class PossessionSkillService
{
    protected $guildMemberRepo;
    protected $possessionSkillRepo;
    private $possessionSkill;
    private $addResultPossessionSkill;

    public function __construct()
    {
    }

    public function addService(StudentNumber $studentNumber,Skill $skill,int $exp): bool
    {
        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
        if(is_null($this->guildMemberRepo->findByStudentNumber($studentNumber))) return false;

        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
        $this->possessionSkill = $this->possessionSkillRepo->findByPossessionSkill($skill);
        if(is_null($this->possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $this->possessionSkill = $possessSkillFactory->possessSkill($skill);
        }
        $this->addResultPossessionSkill = AddProcessSpec::addExp($this->possessionSkill, $exp);

        //スキルレベルアップすればイベントを発行（$studentNUmberの人がスキルレベルXあがりました）

        return $this->possessionSkillRepo->save($this->addResultPossessionSkill);
    }
}
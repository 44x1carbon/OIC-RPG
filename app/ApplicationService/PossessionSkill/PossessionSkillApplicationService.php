<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/10
 * Time: 15:07
 */

namespace App\ApplicationService\PossessionSkill;


use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\AddProcess;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\Skill;
use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;

class PossessionSkillApplicationService
{
    protected $possessionSkillRepo;

    public function __construct(PossessionSkillRepositoryInterface $repo)
    {
        $this->possessionSkillRepo = $repo;
    }

    public function addExpService(StudentNumber $studentNumber, Skill $skill, int $exp): bool
    {
        /* @var PossessionSkill $possessionSkill */
        /* @var PossessionSkill $addResultPossessionSkill */

        if(!GuildMemberSpec::isExistStudentNumber($studentNumber)) return false;

        $possessionSkill = $this->possessionSkillRepo->findBySkill($skill);
        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->possessSkill($skill);
        }

        $possessionSkillDomainService = new PossessionSkillDomainService($this->possessionSkillRepo);
        $result = $possessionSkillDomainService->addService($possessionSkill, $exp);

        if($result)
        {
            $addResultPossessionSkill = $this->possessionSkillRepo->findBySkill($skill);
            //AddExpイベント発火
            if($possessionSkill->totalExp() < $addResultPossessionSkill->totalExp())
                event(new AddExpEvent($addResultPossessionSkill));
            //LevelUpイベント発火
            if($possessionSkill->skillLevel() < $addResultPossessionSkill->skillLevel())
                event(new LevelUpEvent($addResultPossessionSkill));
        }
        return $result;
    }
}
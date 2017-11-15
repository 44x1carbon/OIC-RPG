<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/10
 * Time: 15:07
 */

namespace App\ApplicationService\PossessionSkill;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\AddProcess;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\Spec\AddProcessSpec;
use App\Domain\Skill\Skill;
use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;

class PossessionSkillApplicationService
{
    protected $possessionSkillRepo;

    public function __construct()
    {
    }

    public function addExpService(StudentNumber $studentNumber, Skill $skill, int $exp): void
    {
        /* @var PossessionSkill $possessionSkill */
        /* @var PossessionSkill $addResultPossessionSkill */

        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
        $possessionSkill = $this->possessionSkillRepo->findByPossessionSkill($skill);

        $possessionSkillDomainService = new PossessionSkillDomainService();
        $result = $possessionSkillDomainService->addService($studentNumber, $skill, $exp);

        if($result)
        {
            $addResultPossessionSkill = $this->possessionSkillRepo->findByPossessionSkill($skill);
            //AddExpイベント発火
            if($possessionSkill->totalExp() < $addResultPossessionSkill->totalExp())
                event(new AddExpEvent($addResultPossessionSkill));
            //LevelUpイベント発火
            if($possessionSkill->skillLevel() < $addResultPossessionSkill->skillLevel())
                event(new LevelUpEvent($addResultPossessionSkill));
        }
    }
}
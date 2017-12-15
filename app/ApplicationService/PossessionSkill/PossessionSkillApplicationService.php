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
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\Skill;
use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;

class PossessionSkillApplicationService
{
    protected $possessionSkillRepo;
    private $possessionSkillDomainService;

    public function __construct(PossessionSkillRepositoryInterface $repo, PossessionSkillDomainService $possessionSkillDomainService)
    {
        $this->possessionSkillRepo = $repo;
        $this->possessionSkillDomainService = $possessionSkillDomainService;
    }

    public function addExpService(StudentNumber $studentNumber, Skill $skill, int $exp): bool
    {
        /* @var PossessionSkill $possessionSkill */
        /* @var PossessionSkill $addResultPossessionSkill */

        if(!GuildMemberSpec::isExistStudentNumber($studentNumber)) return false;

        $possessionSkillCollection = new PossessionSkillCollection();
        $possessionSkill = $possessionSkillCollection->findPossessionSkill($skill, $studentNumber);

        $result = $this->possessionSkillDomainService->addExpService($possessionSkill, $exp);

        if($result)
        {
            $addResultPossessionSkill = $this->possessionSkillRepo->findBySkillAndStudentNumber($skill, $studentNumber);
            //AddExpイベント発火
            if($addResultPossessionSkill != null && $exp > 0)
                event(new AddExpEvent($addResultPossessionSkill));
            //LevelUpイベント発火
            if($addResultPossessionSkill != null && $possessionSkill->skillLevel() < $addResultPossessionSkill->skillLevel())
                event(new LevelUpEvent($addResultPossessionSkill));
        }
        return $result;
    }


}
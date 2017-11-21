<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/10
 * Time: 15:07
 */

namespace App\ApplicationService\PossessionSkill;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
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
    protected $guildMemberRepo;
    protected $possessionSkillRepo;

    public function __construct(
        PossessionSkillRepositoryInterface $possessionSkillRepository,
        GuildMemberRepositoryInterface $guildMemberRepository
    )
    {
        $this->possessionSkillRepo = $possessionSkillRepository;
        $this->guildMemberRepo = $guildMemberRepository;
    }

    public function addExpService(StudentNumber $studentNumber, Skill $skill, int $exp): bool
    {
        /* @var PossessionSkill $possessionSkill */
        /* @var PossessionSkill $addResultPossessionSkill */

        if(!GuildMemberSpec::isExistStudentNumber($studentNumber)) return false;

//      誰の所持スキルか判定
        $guildMember = $this->guildMemberRepo->findByStudentNumber($studentNumber);
        $allPossessionSkill= $guildMember->possessionSkill();
//      どのスキルか判定
        $possessionSkill = $this->findBySkill($allPossessionSkill, $skill);

        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->createPossessionSkill($skill);
        }

        $possessionSkillDomainService = new PossessionSkillDomainService($this->possessionSkillRepo);
        $result = $possessionSkillDomainService->addService($possessionSkill, $exp);

        $guildMember->setPossessionSkill($possessionSkill);
        $this->guildMemberRepo->save($guildMember);
        $guildMember = $this->guildMemberRepo->findByStudentNumber($studentNumber);
        $allPossessionSkill= $guildMember->possessionSkill();
        dd($guildMember);

        if($result)
        {
            $addResultPossessionSkill = $this->findBySkill($allPossessionSkill, $skill);
            //AddExpイベント発火
            if($possessionSkill->totalExp() < $addResultPossessionSkill->totalExp())
                event(new AddExpEvent($addResultPossessionSkill));
            //LevelUpイベント発火
            if($possessionSkill->skillLevel() < $addResultPossessionSkill->skillLevel())
                event(new LevelUpEvent($addResultPossessionSkill));
        }
        return $result;
    }

    public function findBySkill(array $allPossessionSkill, Skill $skill): ?PossessionSkill
    {
        $result = array_filter($allPossessionSkill, function(PossessionSkill $possessionSkill) use($skill){
            return $possessionSkill->skill()->skillId() === $skill->skillId();
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }
}
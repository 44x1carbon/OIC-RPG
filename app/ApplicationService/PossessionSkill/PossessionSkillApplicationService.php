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
    protected $guildMemberRepo;

    public function __construct(
        PossessionSkillRepositoryInterface $possessionSkillRepository,
        GuildMemberRepositoryInterface $guildMemberRepository)
    {
        $this->possessionSkillRepo = $possessionSkillRepository;
        $this->guildMemberRepo = $guildMemberRepository;
    }

    public function addExpService(StudentNumber $studentNumber, string $skillId, int $exp): bool
    {
        /* @var PossessionSkill $possessionSkill */
        /* @var PossessionSkill $addResultPossessionSkill */

        if(!GuildMemberSpec::isExistStudentNumber($studentNumber)) return false;

        $guildMember = $this->guildMemberRepo->findByStudentNumber($studentNumber);
        $possessionSkill = $guildMember->possessionSkills()->findPossessionSkill($skillId);
        if(is_null($possessionSkill)){
            if($guildMember->learnSkill($skillId)) $possessionSkill = $guildMember->possessionSkills()->findPossessionSkill($skillId);
        }

        $result = $guildMember->gainExp($possessionSkill, $exp);

        if($result)
        {
            $addResultPossessionSkill = $this->possessionSkillRepo->findBySkillAndStudentNumber($skillId, $studentNumber);
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
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/19
 * Time: 16:09
 */

namespace tests\Domain\GuildMember;


use App\Domain\Course\Course;
use App\Domain\GetCondition\GetCondition;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\JobAcquisitionStatus;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\MemberJobStatus;
use App\Domain\GuildMember\ValueObjects\MemberSkillStatus;
use App\Domain\GuildMember\ValueObjects\SkillAcquisitionStatus;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\Job;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use Tests\SampleGuildMember;
use Tests\TestCase;

class GuildMemberTest extends TestCase
{
    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;
    /* @var GuildMember $guildMember */
    private $guildMember;
    /* @var Skill $skill */
    private $skill;
    /* @var SkillFactory $skillFactory */
    private $skillFactory;


    public function setUp()
    {
        parent::setUp();
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->skillFactory = app(SkillFactory::class);

        $this->skillFactory = new SkillFactory();
        $this->skill = $this->skillFactory->createSkill('php');

        $studentNumber = new StudentNumber('B4300');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');
        $possessionSkills = [];
        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($this->skill->skillId(), $studentNumber);
        $possessionSkills[] = $possessionSkill;
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $guildMemberFactory = new GuildMemberFactory();
        $this->guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::studentName => $studentName,
            SampleGuildMember::gender => $gender,
            SampleGuildMember::mailAddress => $mailAddress,
            SampleGuildMember::possessionSkills => $possessionSkillCollection,
        ]);
    }

    public function testLearnSkill()
    {
        $skill1 = $this->skillFactory->createSkill('java');
        $this->guildMember->learnSkill($skill1->skillId());

        $this->assertTrue(!is_null($this->guildMember->possessionSkills()->findPossessionSkill($skill1->skillId())));
    }

    public function testGainExp()
    {
        $exp = 100;

        $possessionSkill = $this->guildMember->possessionSkills()->findPossessionSkill($this->skill->skillId());

        $afterPossessionSkill = $this->guildMember->gainExp($possessionSkill, $exp);

        $this->assertTrue($possessionSkill->totalExp() + $exp === $afterPossessionSkill->totalExp()
                        && $possessionSkill->skillLevel() !== $afterPossessionSkill->skillLevel());
    }

    public function testSkillAcquisitionList()
    {
        /* テスト対象のGuildMemberを作成 */
        $allSkill = $this->skillRepo->all();
        $guildMember = $this->sampleGuildMember();
        $learnedSkills = array_random($allSkill, 5);

        /* @var Skill $learnedSkill */
        foreach ($learnedSkills as $learnedSkill) {
            $guildMember->learnSkill($learnedSkill->skillId());
        }

        $learnedSkillIds = array_map(function(Skill $skill) {
            return $skill->skillId();
        }, $learnedSkills);

        $rightSkillAcquisitionList = array_map(function(Skill $skill) use($learnedSkillIds, $guildMember){
            if(in_array($skill->skillId(), $learnedSkillIds)) {
                $possessionSkill = $guildMember->possessionSkills()->findPossessionSkill($skill->skillId());
                return new MemberSkillStatus($skill->skillId(), SkillAcquisitionStatus::LEARNED(), $possessionSkill);
            } else {
                return new MemberSkillStatus($skill->skillId(), SkillAcquisitionStatus::NOT_LEARNED());
            }
        }, $allSkill);

        $this->assertTrue($rightSkillAcquisitionList == $guildMember->skillAcquisitionList());
    }

    public function testJobAcquisitionList()
    {
        $studentNumber = new StudentNumber('B4080');

        $learnedJobs = [
            $this->jobRepo()->findByName('Webエンジニア'),
            $this->jobRepo()->findByName('ネットワークエンジニア'),
        ];

        $gettableJobs = [
            $this->jobRepo()->findByName('ゲームプログラマー'),
            $this->jobRepo()->findByName('ゲームグラフィッカー'),
        ];

        $learnedPossessionJobs = array_map(function(Job $job) use($studentNumber){
            return new PossessionJob($studentNumber, $job->jobId());
        }, $learnedJobs);

        /* gettableJobsをPossessionSkillの配列に変換し、１次元配列化 */
        $possessionSkills = array_flatten(array_map(function(Job $job) use($studentNumber){
            /* JobのGetConditionsからPossessionSkillに変換 */
            return array_map(function(GetCondition $condition) use($studentNumber){
                return new PossessionSkill(
                    $studentNumber,
                    $condition->skillId(),
                    $condition->requiredLevel(),
                    PossessionSkill::LEVEL_UP_INTERVAL * $condition->requiredLevel()
                );
            }, $job->getConditions());
        }, $gettableJobs));

        $guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::possessionSkills => new PossessionSkillCollection($possessionSkills),
            SampleGuildMember::possessionJobCollection => new PossessionJobCollection($learnedPossessionJobs)
        ]);

        $learnedJobIds = array_map(function(Job $job) { return $job->jobId()->code(); }, $learnedJobs);
        $gettableJobIds = array_map(function(Job $job) { return $job->jobId()->code(); }, $gettableJobs);

        /* @var MemberJobStatus $memberJobStatus */
        foreach ($guildMember->jobAcquisitionList() as $memberJobStatus) {
            if(in_array($memberJobStatus->jobId()->code(), $learnedJobIds)) {
                $this->assertTrue($memberJobStatus->status() == JobAcquisitionStatus::learned());
            }
            else if(in_array($memberJobStatus->jobId()->code(), $gettableJobIds)) {
                $this->assertTrue($memberJobStatus->status() == JobAcquisitionStatus::gettable());
            }
            else {
                $this->assertTrue($memberJobStatus->status() == JobAcquisitionStatus::notLearned());
            }
        }
    }
}

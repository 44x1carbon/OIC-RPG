<?php

use App\ApplicationService\PossessionJobAppService;
use App\Domain\Course\Course;
use App\Domain\GetCondition\GetCondition;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use Tests\SampleGuildMember;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 7:07
 */


class PossessionJobAppServiceTest extends TestCase
{
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    protected $guildMemberRepo;
    /* @var JobRepositoryInterface $jobRepo */
    protected $jobRepo;
    /* @var PossessionJobAppService $possessionJobAppService */
    private $possessionJobAppService;
    /* @var GuildMember $guildMember */
    private $guildMember;
    /* @var Job $job */
    private $job;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
        $this->jobRepo = app(JobRepositoryInterface::class);
        $this->possessionJobAppService = app(PossessionJobAppService::class);

        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');

        $jobId = $this->jobRepo->nextId();
        $getCondition = new GetCondition($skill->skillId(), 10);
        $getConditions[] = $getCondition;
        $this->job = new Job($jobId, 'サーバーサイドエンジニア', 'hoge\hoge', $getConditions);
        $this->jobRepo->save($this->job);

        $studentNumber = new StudentNumber('B4300');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');

        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($skill->skillId(), $studentNumber);
        $possessionSkill->setSkillLevel(10);
        $possessionSkills[] = $possessionSkill;
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $possessionJobs = [];
        $possessionJobCollection = new PossessionJobCollection($possessionJobs);

        $this->guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::studentName => $studentName,
            SampleGuildMember::gender => $gender,
            SampleGuildMember::mailAddress => $mailAddress,
            SampleGuildMember::possessionSkills => $possessionSkillCollection,
            SampleGuildMember::possessionJobCollection => $possessionJobCollection
        ]);

        $this->guildMemberRepo->save($this->guildMember);
    }

    public function testSuccess()
    {
        $jobId = $this->possessionJobAppService->getJob($this->guildMember->studentNumber(), $this->job->jobId());
        $guildMember = $this->guildMemberRepo->findByStudentNumber($this->guildMember->studentNumber());

        $this->assertTrue(!is_null($guildMember->possessionJobs()->findPossessionJob($jobId)));
    }

}

<?php

use App\Domain\Course\Course;
use App\Domain\GetCondition\GetCondition;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Factory\SkillFactory;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 6:38
 */


class PossessionJobCollectionTest extends TestCase
{
    /* @var GuildMember $guildMember */
    private $guildMember;
    /* @var Job $androidMaster */
    private $androidMaster;

    public function setUp()
    {
        parent::setUp();
        $jobRepo = app(JobRepositoryInterface::class);
        $skillFactory = app(SkillFactory::class);

        $skillFactory = new SkillFactory();
        $androidSkill = $skillFactory->createSkill('android');

        $studentNumber = new StudentNumber('B4300');
        $studentName = '新原佑亮';
        $course = new Course('1', 'ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');

        $possessionSkills = [];
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $jobId1 = $jobRepo->nextId();
        $androidMasterGetCondition1 = new GetCondition($androidSkill->skillId(), 9);
        $androidMasterGetConditions[] = $androidMasterGetCondition1;
        $this->androidMaster = new Job($jobId1, 'アンドロイドマスター', 'hoge\hoge', $androidMasterGetConditions);

        $possessionJobs = [];
        $possessionJob = new PossessionJob($studentNumber, $this->androidMaster->jobId());
        $possessionJobs[] = $possessionJob;
        $possessionJobCollection = new PossessionJobCollection($possessionJobs);

        $guildMemberFactory = new GuildMemberFactory();
        $this->guildMember = $guildMemberFactory->createGuildMember(
            $studentNumber,
            $studentName,
            $course,
            $gender,
            $mailAddress,
            $possessionSkillCollection,
            $possessionJobCollection);
    }

    public function testFindPossessionJob()
    {
        $this->assertTrue(!is_null($this->guildMember->possessionJobs()->findPossessionJob($this->androidMaster->jobId())));
    }
}

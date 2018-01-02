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
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionJob\GetJobSpec;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use Tests\SampleGuildMember;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 4:19
 */


class GetJobSpecTest extends TestCase
{
    /* @var GuildMember $guildMember */
    private $guildMember;

    private $androidMaster;
    /* @var Job $androidEngineer */
    private $androidEngineer;
    private $webDesigner;

    public function setUp()
    {
        parent::setUp();
        $jobRepo = app(JobRepositoryInterface::class);

        $skillFactory = new SkillFactory();
        $androidSkill = $skillFactory->createSkill('android');
        $javaSkill = $skillFactory->createSkill('java');
        $cssSkill = $skillFactory->createSkill('css');

        $studentNumber = new StudentNumber('B4300');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');

        $possessionSkills = [];
        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($androidSkill->skillId(), $studentNumber);
        $possessionSkill->setSkillLevel(5);
        $possessionSkills[] = $possessionSkill;
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($javaSkill->skillId(), $studentNumber);
        $possessionSkill->setSkillLevel(5);
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

        $jobId1 = $jobRepo->nextId();
        $androidMasterGetCondition1 = new GetCondition($androidSkill->skillId(), 9);
        $androidMasterGetCondition2 = new GetCondition($javaSkill->skillId(), 5);
        $androidMasterGetConditions[] = $androidMasterGetCondition1;
        $androidMasterGetConditions[] = $androidMasterGetCondition2;
        $this->androidMaster = new Job($jobId1, 'アンドロイドマスター', 'hoge\hoge', $androidMasterGetConditions);

        $jobId2 = $jobRepo->nextId();
        $androidEngineerGetCondition1 = new GetCondition($androidSkill->skillId(), 5);
        $androidEngineerGetCondition2 = new GetCondition($javaSkill->skillId(), 5);
        $androidEngineerGetConditions[] = $androidEngineerGetCondition1;
        $androidEngineerGetConditions[] = $androidEngineerGetCondition2;
        $this->androidEngineer = new Job($jobId2, 'アンドロイドエンジニア', 'hoge\fuga', $androidEngineerGetConditions);

        $jobId3 = $jobRepo->nextId();
        $webDesignerGetCondition1 = new GetCondition($cssSkill->skillId(), 5);
        $webDesignerGetConditions[] = $webDesignerGetCondition1;
        $this->webDesigner = new Job($jobId3, 'ウェブデザイナー', 'fuga\hoge', $webDesignerGetConditions);
    }

    public function testValidateRequirement()
    {
        $this->assertFalse(GetJobSpec::validateRequirement($this->guildMember->possessionSkills(), $this->androidMaster));
        $this->assertTrue(GetJobSpec::validateRequirement($this->guildMember->possessionSkills(), $this->androidEngineer));
        $this->assertFalse(GetJobSpec::validateRequirement($this->guildMember->possessionSkills(), $this->webDesigner));
    }

    public function testIsExistPossessionJob()
    {
        $possessionJob = new PossessionJob($this->guildMember->studentNumber(), $this->androidEngineer->jobId());
        $this->guildMember->possessionJobs()->append($possessionJob);

        $this->assertTrue(GetJobSpec::isExistPossessionJob($this->guildMember->possessionJobs(), $this->androidEngineer->jobId()));
    }
}

<?php

use App\ApplicationService\PossessionSkill\PossessionSkillApplicationService;
use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/17
 * Time: 13:05
 */


class PossessionSkillApplicationServiceTest extends \Tests\TestCase
{
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    protected $guildMemberRepo;

    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;
    protected $possessionSkillRepo;

    private $studentNumber;
    private $skill;

    public function setUp()
    {
        parent::setUp();

        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);

        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
        $this->studentNumber = new StudentNumber('B4074');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');
        $guildMemberFactory = new GuildMemberFactory();
        $guildMember = $guildMemberFactory->createGuildMember($this->studentNumber, $studentName, $course, $gender, $mailAddress);
        $this->guildMemberRepo->save($guildMember);

        $this->skillRepo = app(SkillRepositoryInterface::class);
        $skillFactory = new SkillFactory();
        $this->skill = $skillFactory->createSkill('php');
    }

    function testSuccess()
    {
        $possessionSkillService = new PossessionSkillApplicationService($this->possessionSkillRepo);
        $this->assertTrue($possessionSkillService->addExpService($this->studentNumber, $this->skill, 100));
    }

    function testFail()
    {
        $studentNumber = new StudentNumber('B7777');
        $possessionSkillService = new PossessionSkillApplicationService($this->possessionSkillRepo);
        $this->assertFalse($possessionSkillService->addExpService($studentNumber, $this->skill,100));
    }
}

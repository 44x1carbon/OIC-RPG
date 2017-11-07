<?php

use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillService;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Service\SkillService;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 18:13
 */


class PossessionServiceTest extends TestCase
{
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    protected $guildMemberRepo;

    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;

    private $studentNumber;
    private $skill;

    public function setUp()
    {
        parent::setUp();

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
        $possessionSkillService = new PossessionSkillService();
        $this->assertTrue($possessionSkillService->addService($this->studentNumber, $this->skill,10));
    }

    function testFail()
    {
        $studentNumber = new StudentNumber('B7777');
        $possessionSkillService = new PossessionSkillService();
        $this->assertFalse($possessionSkillService->addService($studentNumber, $this->skill,10));
    }
}

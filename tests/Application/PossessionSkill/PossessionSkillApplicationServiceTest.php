<?php

use App\ApplicationService\PossessionSkill\PossessionSkillApplicationService;
use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;

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

    private $studentNumber;
    /* @var Skill $skill */
    private $skill;

    public function setUp()
    {
        parent::setUp();

        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
        $this->skillRepo = app(SkillRepositoryInterface::class);

        $skillFactory = new SkillFactory();
        $this->skill = $skillFactory->createSkill('php');

        $this->studentNumber = new StudentNumber('B4300');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');
        $possessionSkills = [];
        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($this->skill->skillId(), $this->studentNumber);
        $possessionSkills[] = $possessionSkill;
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $guildMemberFactory = new GuildMemberFactory();
        $guildMember = $guildMemberFactory->createGuildMember($this->studentNumber, $studentName, $course, $gender, $mailAddress, $possessionSkillCollection);
        $this->guildMemberRepo->save($guildMember);
    }

    function testSuccess()
    {
        $possessionSkillService = new PossessionSkillApplicationService($this->guildMemberRepo);
        $this->assertTrue($possessionSkillService->addExpService($this->studentNumber, $this->skill->skillId(), 100));
    }

    function testFail()
    {
        $studentNumber = new StudentNumber('B7777');
        $possessionSkillService = new PossessionSkillApplicationService($this->guildMemberRepo);
        $this->assertFalse($possessionSkillService->addExpService($studentNumber, $this->skill->skillId(),100));
    }
}

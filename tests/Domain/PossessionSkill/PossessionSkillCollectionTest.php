<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 14:01
 */

namespace tests\Domain\PossessionSkill;


use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\PossessionSkill;
use Tests\TestCase;

class PossessionSkillCollectionTest extends TestCase
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
        $this->guildMember = $guildMemberFactory->createGuildMember($studentNumber, $studentName, $course, $gender, $mailAddress, $possessionSkillCollection);
    }

    public function testFindPossessionSkill()
    {
        $this->assertTrue(!is_null($this->guildMember->possessionSkills()->findPossessionSkill($this->skill->skillId())));
    }


    public function testGetOffset()
    {
        $offset = $this->guildMember->possessionSkills()->getOffset($this->skill->skillId());
        /* @var PossessionSkill $possessionSkill */
        $possessionSkill = $this->guildMember->possessionSkills()->offsetGet($offset);

        $this->assertTrue($possessionSkill == $this->guildMember->possessionSkills()->findPossessionSkill($this->skill->skillId()));
    }
}

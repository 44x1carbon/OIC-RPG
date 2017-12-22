<?php

use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
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


class PossessionSkillTest extends TestCase
{
    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;

    /* @var \App\Domain\PossessionSkill\PossessionSkill $possessionSkill */
    private $possessionSkill;

    public function setUp()
    {
        parent::setUp();

        $this->skillRepo = app(SkillRepositoryInterface::class);

        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');

        $studentNumber = new StudentNumber('b4000');

        $possessSkillFactory = new PossessionSkillFactory();
        $this->possessionSkill = $possessSkillFactory->createPossessionSkill($skill->skillId(), $studentNumber);
    }

    public function testAddExp()
    {
        $exp = 100;
        $afterPossessionSkill = PossessionSkill::addExp($this->possessionSkill,$exp);
        $this->assertTrue($this->possessionSkill->totalExp() + $exp === $afterPossessionSkill->totalExp());
    }

    public function testLevelUp()
    {
        $exp = 100;

        $afterPossessionSkill = PossessionSkill::addExp($this->possessionSkill,$exp);
        $resultPossessionSkill = PossessionSkill::levelUp($this->possessionSkill, $afterPossessionSkill);

        $this->assertTrue($resultPossessionSkill->skillLevel() !== $this->possessionSkill->skillLevel());
    }
}

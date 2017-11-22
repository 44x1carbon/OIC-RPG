<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 15:42
 */

namespace Tests\Repository;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use Tests\TestCase;

class PossessionSkillRepositoryTest extends TestCase
{
    /* @var PossessionSkillRepositoryInterface $possessionSkillRepo */
    protected $possessionSkillRepo;
    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;
    private $studentNumber;

    public function setUp()
    {
        parent::setUp();
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);

        $this->studentNumber = new StudentNumber('b4000');
    }

    public function testFindBySkillAndStudentNumber()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'java');

        $PossessionSkillFactory = new PossessionSkillFactory();
        $possessSkill = $PossessionSkillFactory->createPossessionSkill($skill, $this->studentNumber);
        $this->possessionSkillRepo->save($possessSkill);

        $findSkill = $this->possessionSkillRepo->findBySkillAndStudentNumber($skill, $this->studentNumber);

        $result = $findSkill->skill()->skillId() === $skill->skillId();
        $this->assertTrue($result);
    }

    public function testSave()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'php');
        $this->skillRepo->save($skill);

        $PossessionSkillFactory = new PossessionSkillFactory();
        $possessSkill = $PossessionSkillFactory->createPossessionSkill($skill, $this->studentNumber);
        $this->possessionSkillRepo->save($possessSkill);
    }
}

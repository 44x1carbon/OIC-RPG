<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 15:42
 */

namespace Tests\Repository;


use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use Tests\TestCase;

class PossessionSkillRepositoryTest extends TestCase
{
    /* @var PossessionSkillRepositoryInterface $possessionSkillRepo */
    protected $possessionSkillRepo;

    public function setUp()
    {
        parent::setUp();
        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
    }

    public function testFindById()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'java');

        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->createPossessionSkill($skill);
        $this->possessionSkillRepo->save($possessionSkill);

        $findId = $this->possessionSkillRepo->findById($possessionSkill->id());

        $result = $findId->Id() === $possessionSkill->id();
        $this->assertTrue($result);
    }

    public function testSave()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'php');

        $PossessionSkillFactory = new PossessionSkillFactory();
        $possessSkill = $PossessionSkillFactory->createPossessionSkill($skill);
        $this->possessionSkillRepo->save($possessSkill);
    }
}

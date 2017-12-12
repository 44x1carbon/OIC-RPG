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

    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;

    public function setUp()
    {
        parent::setUp();
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
    }

    public function testFindByPossessionSkill()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'java');
        $this->skillRepo->save($skill);

        $PossessionSkillFactory = new PossessionSkillFactory();
        $possessSkill = $PossessionSkillFactory->createPossessionSkill($skill);
        $this->possessionSkillRepo->save($possessSkill);

        $findSkill = $this->possessionSkillRepo->findBySkill($skill);

        $result = $findSkill->skill()->skillId() == $skill->skillId();
        $this->assertTrue($result);

    }

    public function testSave()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'php');
        $this->skillRepo->save($skill);

        $PossessionSkillFactory = new PossessionSkillFactory();
        $possessSkill = $PossessionSkillFactory->createPossessionSkill($skill);
        $this->possessionSkillRepo->save($possessSkill);
    }
}

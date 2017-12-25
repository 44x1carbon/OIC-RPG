<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 15:16
 */

namespace Tests\Repository;

use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use Tests\TestCase;

class SkillRepositoryTest extends TestCase
{
    /* @var SkillRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(SkillRepositoryInterface::class);
    }

    public function testFindBySkillId()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill( 'java');
        $this->repo->save($skill);

        $findId = $this->repo->findBySkillId($skill->skillId());

        $result = $findId->skillId() === $skill->skillId();
        $this->assertTrue($result);
    }

    public function testSave()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');
        $this->assertTrue($this->repo->save($skill));
    }

    public function testAll()
    {
        $registerSkills = [];
        $registerSkillIds = [];

        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');
        $this->repo->save($skill);
        $skill1 = $skillFactory->createSkill('java');
        $this->repo->save($skill1);

        $registerSkills[] = $skill;
        $registerSkills[] = $skill1;

        /* @var Skill $registerSkill */
        foreach ($registerSkills as $registerSkill) {
            $registerSkillIds[] = $registerSkill->skillId();
        }

        $getSkills = $this->repo->all();
        $getSkillIds = [];
        /* @var Skill $getSkill */
        foreach ($getSkills as $getSkill){
            $getSkillIds[] = $getSkill->skillId();
        }

        $this->assertEmpty(array_diff($registerSkillIds, $getSkillIds));
    }
}

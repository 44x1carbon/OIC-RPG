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
        $skill = SkillFactory::createSkill('ab2', 'java');
        $this->repo->save($skill);

        $findId = $this->repo->findBySkillId('ab2');

        $result = $findId->skillId() === $skill->skillId();
        $this->assertTrue($result);
    }

    public function testSave()
    {
        $skill = SkillFactory::createSkill('ab1', 'php');
        $this->assertTrue($this->repo->save($skill));
    }
}

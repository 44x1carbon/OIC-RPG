<?php

use App\Domain\Skill\Skill;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Service\SkillService;
use App\Domain\Skill\Spec\SkillSpec;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 15:13
 */


class SkillSpecTest extends \Tests\TestCase
{
    protected $repo;
    private $registerId;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(SkillRepositoryInterface::class);
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('java');
        $this->repo->save($skill);
        $this->registerId = $skill->skillId();
    }

    function testisExistsSkillIdSuccess()
    {
        $this->assertTrue(SkillSpec::isExistsSkillId($this->registerId));
    }

    function testisExistsSkillIdFail()
    {
        $this->assertFalse(SkillSpec::isExistsSkillId('abki'));
    }

    function testisExistsSkillNameSuccess()
    {
        $this->assertTrue(SkillSpec::isExistsSkillName('java'));
    }

    function testisExistsSkillNameFail()
    {
        $this->assertFalse(SkillSpec::isExistsSkillName('php'));
    }
}
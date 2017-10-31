<?php

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

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(SkillRepositoryInterface::class);
        $skill = SkillFactory::createSkill('ab1', 'java');
        $this->repo->save($skill);
    }

    function testisExistsSkillIdSuccess()
    {
        $this->assertTrue(SkillSpec::isExistsSkillId('ab1'));
    }

    function testisExistsSkillIdFail()
    {
        $this->assertFalse(SkillSpec::isExistsSkillId('ab2'));
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
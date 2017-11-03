<?php

use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Service\SkillService;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 14:47
 */



class SkillServiceTest extends \Tests\TestCase
{
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(SkillRepositoryInterface::class);
    }

    function testSuccess()
    {
        //$result = new SkillService('php');
        $this->assertTrue(SkillService::registerService('php'));
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        //$result = new SkillService('php');
        $this->assertTrue(SkillService::registerService('php'));
        //$result1 = new SkillService('php');
        $this->assertTrue(SkillService::registerService('php'));
    }
}

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
        $result = SkillService::registerService('ab1', 'php');
        $this->assertTrue($result);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $result = SkillService::registerService('ab1', 'php');
        $result1 = SkillService::registerService('ab1', 'php');
    }
}

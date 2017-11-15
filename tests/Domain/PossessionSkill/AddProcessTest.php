<?php

use App\Domain\PossessionSkill\AddProcess;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Factory\SkillFactory;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 18:15
 */


class AddProcessTest extends TestCase
{
    /* @var PossessionSkill $this->possessionSkill */
    private $possessionSkill;

    public function setUp()
    {
        parent::setUp();

        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');

        $possessionSkillFactory = new PossessionSkillFactory();
        $this->possessionSkill = $possessionSkillFactory->possessSkill($skill);
    }

    public function testAddExp()
    {
        $exp = 100;
        $afterPossessionSkill = AddProcess::addExp($this->possessionSkill,$exp);
        $this->assertTrue($this->possessionSkill->totalExp() + $exp === $afterPossessionSkill->totalExp());
    }

    public function testLevelUp()
    {
        $exp = 100;
        $this->possessionSkill->setTotalExp(225);

        $afterPossessionSkill = clone $this->possessionSkill;
        $afterPossessionSkill->setTotalExp($this->possessionSkill->totalExp() + $exp);

        $result = AddProcess::levelUp($this->possessionSkill, $afterPossessionSkill);
        $this->assertTrue($result === 1);
    }

}

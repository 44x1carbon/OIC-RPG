<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/22
 * Time: 18:37
 */

namespace App\Domain\GetCondition;


use App\Domain\Skill\Skill;

class GetCondition
{
    private $skill;
    private $requiredLevel;

    public function __construct()
    {
    }

    public function setSkill(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function setRequiredLevel(int $requiredLevel)
    {
        $this->requiredLevel = $requiredLevel;
    }

    public function skill(): Skill
    {
        return $this->skill;
    }

    public function requiredLevel(): int
    {
        return $this->requiredLevel;
    }
}
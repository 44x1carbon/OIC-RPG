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
    private $skillId;
    private $requiredLevel;

    public function __construct()
    {
    }

    public function setSkillId(string $skillId)
    {
        $this->skillId = $skillId;
    }

    public function setRequiredLevel(int $requiredLevel)
    {
        $this->requiredLevel = $requiredLevel;
    }

    public function skillId(): string
    {
        return $this->skillId;
    }

    public function requiredLevel(): int
    {
        return $this->requiredLevel;
    }
}
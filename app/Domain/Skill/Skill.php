<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 12:45
 */

namespace App\Domain\Skill;

class Skill
{
    private $skillId;
    private $skillName;

    public function __construct()
    {
    }

    public function setSkillId(String $skillId)
    {
        $this->skillId = $skillId;
    }

    public function setSkillName(String $skillName)
    {
        $this->skillName = $skillName;
    }

    public function skillId(): String
    {
        return $this->skillId;
    }

    public function skillName(): String
    {
        return $this->skillName;
    }

}
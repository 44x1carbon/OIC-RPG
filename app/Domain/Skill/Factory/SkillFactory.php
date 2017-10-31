<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 12:56
 */

namespace App\Domain\Skill\Factory;


use App\Domain\Skill\Skill;

class SkillFactory
{
    public function __construct()
    {
    }

    //クリエイトスキル

    public static function createSkill(String $skillId, String $skillName): Skill
    {
        $skill = new Skill();
        $skill->setSkillId($skillId);
        $skill->setSkillName($skillName);
        return $skill;
    }
}
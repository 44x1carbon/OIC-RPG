<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 12:56
 */

namespace App\Domain\Skill\Factory;


use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\DomainUtility\RandomStringGenerator;

class SkillFactory
{
    protected $repo;

    //クリエイトスキル

    public function createSkill(String $skillName): Skill
    {
        $skill = new Skill();
        $skill->setSkillId($this->makeId());
        $skill->setSkillName($skillName);
        return $skill;
    }

    public function makeId()
     {
         $this->repo = app(SkillRepositoryInterface::class);
         $randId = RandomStringGenerator::makeLowerCase(4);
         $addFlg = false;
         while ($addFlg)
         if (!is_null($this->repo->findBySkillId($randId))){
             $randId = RandomStringGenerator::makeLowerCase(4);
         }else{
                $addFlg = true;
         }
         return $randId;
     }
}
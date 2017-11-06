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
        $skill->setSkillId($this->makeSkillId());
        $skill->setSkillName($skillName);
        return $skill;
    }

    public function makeSkillId(): String
     {
         $this->repo = app(SkillRepositoryInterface::class);

         do{
             $randId = RandomStringGenerator::makeLowerCase(4);
         }while(!is_null($this->repo->findBySkillId($randId)));
         
         return $randId;
     }
}
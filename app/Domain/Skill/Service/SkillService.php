<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 13:08
 */

namespace App\Domain\Skill\Service;


use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Spec\SkillSpec;
use App\Exceptions\DomainException;

class SkillService
{
    //スキルの作成から名前判定を行うクラス

    //スキル作成フロー
    public static function registerService(String $skillId, String $skillName): bool
    {
        if(SkillSpec::isExistsSkillId($skillId)) throw new DomainException("Error");
        if(SkillSpec::isExistsSkillName($skillName)) throw new DomainException("Error");

        $skill = SkillFactory::createSkill($skillId, $skillName);

        /* @var SkillRepositoryInterface $repo */
        $repo = app(SkillRepositoryInterface::class);
        return $repo->save($skill);
    }
}
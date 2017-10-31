<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 12:53
 */

namespace App\Domain\Skill\Spec;


use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\DomainUtility\SpecTrait;

class SkillSpec
{
    use SpecTrait;

    public static function isExistsSkillId(String $skillId): bool
    {
        /* @var SkillRepositoryInterface $repo */
        $repo = app(SkillRepositoryInterface::class);
        $skill = $repo->findBySkillId($skillId);
        return $skill !== null;
    }

    public static function isExistsSkillName(String $skillName): bool
    {
        /* @var SkillRepositoryInterface $repo */
        $repo = app(SkillRepositoryInterface::class);
        $skill = $repo->findBySkillName($skillName);
        return $skill !== null;
    }
}
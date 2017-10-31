<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 13:11
 */

namespace App\Domain\Skill\RepositoryInterface;


use App\Domain\Skill\Skill;

interface SkillRepositoryInterface
{
    public function findBySkillId(String $skillId): ?Skill;

    public function findBySkillName(String $skillName): ?Skill;

    public function save(Skill $skill): bool;

    public function all(): array;
}
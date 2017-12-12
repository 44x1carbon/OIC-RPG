<?php

namespace App\Domain\PossessionSkill\RepositoryInterface;

use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 13:01
 */

interface PossessionSkillRepositoryInterface
{
    public function findById(string $id): ?PossessionSkill;

    public function findBySkill(Skill $skill): ?PossessionSkill;

    public function save(PossessionSkill $possessionSkill): bool;

    public function all(): array;
}
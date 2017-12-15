<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 12:20
 */

namespace App\Domain\WantedRole\RepositoryInterface;


use App\Domain\WantedRole\WantedRole;

interface WantedRoleRepositoryInterface
{
    public function findById(String $id): ?WantedRole;

    public function save(WantedRole $wantedRole): bool;

    public function all(): array;
}
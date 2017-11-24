<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:07
 */

namespace App\Domain\WantedMember\RepositoryInterface;

use App\Domain\WantedMember\WantedMember;

interface WantedMemberRepositoryInterface
{
    public function findById(String $id): ?WantedMember;

    public function save(WantedMember $wantedMember): bool;

    public function all(): array;
}
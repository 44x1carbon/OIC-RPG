<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:07
 */

namespace App\Domain\MemberRecruitment\RepositoryInterface;

use App\Domain\MemberRecruitment\MemberRecruitment;

interface MemberRecruitmentRepositoryInterface
{
    public function findById(String $id): ?MemberRecruitment;

    public function save(MemberRecruitment $memberRecruitment): bool;

    public function all(): Array;
}
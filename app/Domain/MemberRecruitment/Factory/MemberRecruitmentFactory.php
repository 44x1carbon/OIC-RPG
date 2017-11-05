<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 12:21
 */

namespace App\Domain\MemberRecruitment\Factory;


use App\Domain\MemberRecruitment\MemberRecruitment;
use App\Domain\MemberRecruitment\ValueObjects\RecruitmentStatus;

class MemberRecruitmentFactory
{

    public function __construct()
    {
    }

    public function createMemberRecruitment(String $id, RecruitmentStatus $recruitmentStatus, int $recruitmentNumbers, String $remarks ): MemberRecruitment
    {
        $MemberRecruitment = new MemberRecruitment();
        $MemberRecruitment->setId($id);
        $MemberRecruitment->setRecruitmentStatus($recruitmentStatus);
        $MemberRecruitment->setRecruitmentNumbers($recruitmentNumbers);
        $MemberRecruitment->setRemarks($remarks);
        return $MemberRecruitment;
    }
}
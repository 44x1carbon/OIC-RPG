<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:22
 */

namespace App\Domain\MemberRecruitment;


use App\Domain\MemberRecruitment\ValueObjects\RecruitmentStatus;

/**
 * メンバー募集Entity
 * Class MemberRecruitment
 * @package App\Domain\MemberRecruitment
 */
class MemberRecruitment
{
    private $id;
    // 募集状況
    private $recruitmentStatus;
    // 募集人数
    private $recruitmentNumbers;
    // 備考
    private $remarks;

    public function __construct()
    {

    }

    public function id(): String
    {
        return $this->id;
    }

    public function recruitmentStatus(): RecruitmentStatus
    {
        return $this->recruitmentStatus;
    }

    public function recruitmentNumbers(): int
    {
        return $this->recruitmentNumbers;
    }

    public function remarks(): String
    {
        return $this->remarks;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setRecruitmentStatus(RecruitmentStatus $recruitmentStatus)
    {
        $this->recruitmentStatus = $recruitmentStatus;
    }

    public function setRecruitmentNumbers(int $recruitmentNumbers)
    {
        $this->recruitmentNumbers = $recruitmentNumbers;
    }

    public function setRemarks(String $remarks)
    {
        $this->remarks = $remarks;
    }
}
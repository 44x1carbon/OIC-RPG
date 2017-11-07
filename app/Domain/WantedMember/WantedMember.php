<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:22
 */

namespace App\Domain\WantedMember;


use App\Domain\WantedMember\ValueObjects\WantedStatus;

/**
 * メンバー募集Entity
 * Class WantedMember
 * @package App\Domain\WantedMember
 */
class WantedMember
{
    private $id;
    // 募集状況
    private $wantedStatus;
    // 募集人数
    private $wantedNumbers;
    // 備考
    private $remarks;

    public function __construct()
    {

    }

    public function id(): String
    {
        return $this->id;
    }

    public function wantedStatus(): WantedStatus
    {
        return $this->wantedStatus;
    }

    public function wantedNumbers(): int
    {
        return $this->wantedNumbers;
    }

    public function remarks(): String
    {
        return $this->remarks;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setWantedStatus(WantedStatus $wantedStatus)
    {
        $this->wantedStatus = $wantedStatus;
    }

    public function setWantedNumbers(int $wantedNumbers)
    {
        $this->wantedNumbers = $wantedNumbers;
    }

    public function setRemarks(String $remarks)
    {
        $this->remarks = $remarks;
    }
}
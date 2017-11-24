<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:22
 */

namespace App\Domain\WantedMember;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
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
    // 役員ID
    private $officerId;

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

    public function officerId(): StudentNumber
    {
        return $this->officerId;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setWantedStatus(WantedStatus $wantedStatus)
    {
        $this->wantedStatus = $wantedStatus;
    }

    public function setOfficerId(StudentNumber $officerId)
    {
        $this->officerId = $officerId;
    }

    public function isWanted(): bool
    {
        return $this->wantedStatus->status() == WantedStatus::OPEN && is_null($this->officerId);
    }
}
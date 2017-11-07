<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 12:21
 */

namespace App\Domain\WantedMember\Factory;


use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedMember\ValueObjects\WantedStatus;

class WantedMemberFactory
{

    public function __construct()
    {
    }

    public function createWantedMember(String $id, WantedStatus $wantedStatus, int $wantedNumbers, String $remarks ): WantedMember
    {
        $WantedMember = new WantedMember();
        $WantedMember->setId($id);
        $WantedMember->setWantedStatus($wantedStatus);
        $WantedMember->setWantedNumbers($wantedNumbers);
        $WantedMember->setRemarks($remarks);
        return $WantedMember;
    }
}
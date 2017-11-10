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
use App\DomainUtility\RandomStringGenerator;

class WantedMemberFactory
{

    public function __construct()
    {
    }

    public function createWantedMember(WantedStatus $wantedStatus, String $officerId, String $id = null ): WantedMember
    {
        $wantedMember = new WantedMember();
        $wantedMember->setId($id??$this->makeid());
        $wantedMember->setWantedStatus($wantedStatus);
        $wantedMember->setOfficerId($officerId);
        return $wantedMember;
    }

    public function makeid()
    {
        $randId = RandomStringGenerator::makeLowerCase(4);
        $reCreateIdFlg = true;
        do {
            if (is_null($this->repo->findById($randId))){
                // findByIdがnullの場合、DBにIDのかぶりがないので正しい
                $reCreateIdFlg = false;
            }else{
                $randId = RandomStringGenerator::makeLowerCase(4);
            }
        } while ($reCreateIdFlg);
        return $randId;
    }
}
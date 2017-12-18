<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 12:21
 */

namespace App\Domain\WantedMember\Factory;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\DomainUtility\RandomStringGenerator;

class WantedMemberFactory
{
    private $repo;

    public function __construct()
    {
        $this->repo = app(WantedMemberRepositoryInterface::class);
    }

    public function createWantedMember(WantedStatus $wantedStatus = null, StudentNumber $officerId = null, String $id = null ): WantedMember
    {
        $wantedMember = new WantedMember();
        $wantedMember->setId($id??$this->makeId());
        $wantedMember->setWantedStatus($wantedStatus??new WantedStatus(WantedStatus::OPEN));
        if ($officerId) {
            $wantedMember->setOfficerId($officerId);
        }
        return $wantedMember;
    }

    public function makeId()
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
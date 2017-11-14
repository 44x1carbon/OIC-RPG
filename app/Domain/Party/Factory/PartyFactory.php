<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 15:49
 */

namespace App\Domain\Party\Factory;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\ProductionIdea;
use App\DomainUtility\RandomStringGenerator;

class PartyFactory
{
    private $repo;

    public function __construct()
    {
        $this->repo = app(PartyRepositoryInterface::class);
    }

    public function createParty(ActivityEndDate $activityEndDate, ProductionIdea $productionIdea,
                                StudentNumber $partyManagerId, array $partyMembers, array $wantedRoles, String $id = null)
    {
        $party = new Party();
        $party->setId($id? $id : $this->makeId());
        $party->setActivityEndDate($activityEndDate);
        $party->setProductionIdea($productionIdea);
        $party->setPartyManagerId($partyManagerId);
        $party->setPartyMembers($partyMembers);
        $party->setWantedRoles($wantedRoles);
        return $party;
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
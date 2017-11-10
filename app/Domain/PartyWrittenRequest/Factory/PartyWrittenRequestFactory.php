<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 10:52
 */

namespace App\Domain\PartyWrittenRequest\Factory;

use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\PartyWrittenRequest;
use App\Domain\PartyWrittenRequest\RepositoryInterface\PartyWrittenRequestRepositoryInterface;
use App\Domain\ProductionIdea\ProductionIdea;
use App\DomainUtility\RandomStringGenerator;

class PartyWrittenRequestFactory
{
    private $partyWrittenRequestRepository;

    public function __construct()
    {
        $this->partyWrittenRequestRepository = app(PartyWrittenRequestRepositoryInterface::class);
    }

    public function createPartyWrittenRequest(String $applicantId, ActivityEndDate $activityEndDate,
                                              ProductionIdea $productionIdea, array $wantedRoleList, String $id)
    {
        $partyWrittenRequest = new PartyWrittenRequest();
        $partyWrittenRequest->setId($id??$this->makeid());
        $partyWrittenRequest->setApplicantId($applicantId);
        $partyWrittenRequest->setActivityEndDate($activityEndDate);
        $partyWrittenRequest->setProductionIdea($productionIdea);
        $partyWrittenRequest->setWantedRoleList($wantedRoleList);
        return $partyWrittenRequest;
    }

    public function makeid()
    {
        $randId = RandomStringGenerator::makeLowerCase(4);
        $reCreateIdFlg = true;
        do {
            if (is_null($this->partyWrittenRequestRepository->findById($randId))){
                // findByIdがnullの場合、DBにIDのかぶりがないので正しい
                $reCreateIdFlg = false;
            }else{
                $randId = RandomStringGenerator::makeLowerCase(4);
            }
        } while ($reCreateIdFlg);
        return $randId;
    }
}
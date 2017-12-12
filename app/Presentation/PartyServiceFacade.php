<?php

namespace App\Presentation;

use App\ApplicationService\PartyAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;

class PartyServiceFacade
{
    function __construct(PartyAppService $service, PartyRepositoryInterface $partyRepository)
    {
        $this->service = $service;
        $this->partyRepository = $partyRepository;
    }

    public function registerParty(
        \DateTime $activityEndDate,
        string $studentNumber,
        string $roleName,
        string $productionTheme = null,
        string $productionTypeId = null,
        string $ideaDescription = null,
        array $wantedRoleList = []
    ): string {
        $partyId = $this->service->registerParty(new ActivityEndDate($activityEndDate->getTimestamp()), new StudentNumber($studentNumber), $roleName);

        $party = $this->partyRepository->findById($partyId);
        $this->servoce->updateProductionIdea($party->id(), $productionTheme, $productionTypeId, $ideaDescription);


        /* @var WantedRoleInfo $wantedRole */
        foreach ($wantedRoleList as $wantedRole) {
            $this->servoce->addWantedRole($party->id(), $wantedRole->roleName(), $wantedRole->referenceJobId(), $wantedRole->remarks(), $wantedRole->frameAmount());
        }

        return $partyId;
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null): string
    {


    }
}
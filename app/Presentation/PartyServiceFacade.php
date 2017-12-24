<?php

namespace App\Presentation;

use App\ApplicationService\PartyAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Presentation\DTO\WantedRoleDto;

class PartyServiceFacade
{
    function __construct(PartyAppService $service, PartyRepositoryInterface $partyRepository)
    {
        $this->servoce = $service;
        $this->partyRepository = $partyRepository;
    }

    public function registerParty(
        string $activityEndDate,
        string $studentNumber,
        string $roleName,
        string $productionTheme = null,
        string $productionTypeId = null,
        string $ideaDescription = null,
        array $wantedRoleList = []
    ): string
    {
        $partyId = $this->servoce->registerParty(new ActivityEndDate($activityEndDate), new StudentNumber($studentNumber), $roleName);

        $party = $this->partyRepository->findById($partyId);
        $this->servoce->updateProductionIdea($party->id(), $productionTheme, $productionTypeId, $ideaDescription);


        /* @var WantedRoleDto $wantedRole */
        foreach ($wantedRoleList as $wantedRole) {
            $this->servoce->addWantedRole($party->id(), $wantedRole->roleName(), $wantedRole->referenceJobId(), $wantedRole->remarks(), $wantedRole->frameAmount());
        }

        return $partyId;
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null): string
    {


    }
}
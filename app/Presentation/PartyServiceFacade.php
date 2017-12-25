<?php

namespace App\Presentation;

use App\ApplicationService\PartyAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Presentation\DTO\PartyDto;
use App\Presentation\DTO\WantedRoleDto;

class PartyServiceFacade
{
    function __construct(PartyAppService $service, PartyRepositoryInterface $partyRepository)
    {
        $this->servoce = $service;
        $this->partyRepository = $partyRepository;
    }

    public function registerParty(
        string $studentNumber,
        PartyDto $partyDto
    ): string
    {
        $managerId = new StudentNumber($studentNumber);
        $partyId = $this->servoce->registerParty(new ActivityEndDate($partyDto->activityEndDate), $managerId);

        $party = $this->partyRepository->findById($partyId);
        $productionIdeaDto = $partyDto->productionIdeaDto;
        $this->servoce->updateProductionIdea($party->id(), $productionIdeaDto->productionTheme, $productionIdeaDto->productionTypeDto->id, $productionIdeaDto->ideaDescription);


        /* @var WantedRoleDto $wantedRoleDto */
        foreach ($partyDto->wantedRoleDtos as $wantedRoleDto) {
            $wantedRoleId = $this->servoce->addWantedRole($party->id(), $wantedRoleDto->roleName, $wantedRoleDto->referenceJobId, $wantedRoleDto->remarks, $wantedRoleDto->frameAmount);
            if($wantedRoleDto->managerAssigned) {
                $party->assignMember($wantedRoleId, $managerId);
            }
        }

        return $partyId;
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null): string
    {


    }
}
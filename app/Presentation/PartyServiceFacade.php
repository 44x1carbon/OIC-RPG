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
        $this->service = $service;
        $this->partyRepository = $partyRepository;
    }

    public function registerParty(
        string $studentNumber,
        PartyDto $partyDto
    ): string
    {
        $managerId = new StudentNumber($studentNumber);
        $partyId = $this->service->registerParty(new ActivityEndDate($partyDto->activityEndDate), $managerId);

        $productionIdeaDto = $partyDto->productionIdeaDto;
        $this->service->updateProductionIdea($partyId, $productionIdeaDto->productionTheme, $productionIdeaDto->productionTypeDto->id, $productionIdeaDto->ideaDescription);


        /* @var WantedRoleDto $wantedRoleDto */
        foreach ($partyDto->wantedRoleDtos as $wantedRoleDto) {
            $wantedRoleId = $this->service->addWantedRole($partyId, $wantedRoleDto->roleName, $wantedRoleDto->referenceJobId, $wantedRoleDto->remarks, $wantedRoleDto->frameAmount);
            if($wantedRoleDto->managerAssigned) {
                $managerRoleId = $wantedRoleId;
            }
        }

        $party = $this->partyRepository->findById($partyId);
        $party->assignMember($managerRoleId, $managerId);
        $this->partyRepository->save($party);

        return $partyId;
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null): string
    {


    }

    public function searchParty(string  $keyword): array
    {
        return $this->service->searchParty($keyword);
    }
}
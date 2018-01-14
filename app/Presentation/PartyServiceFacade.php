<?php

namespace App\Presentation;

use App\ApplicationService\PartyAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Presentation\DTO\PartyDto;
use App\Presentation\DTO\WantedRoleDto;

class PartyServiceFacade
{
    function __construct(PartyAppService $service, PartyRepositoryInterface $partyRepository, PartyParticipationRequestFacade $partyParticipationRequestFacade)
    {
        $this->service = $service;
        $this->partyRepository = $partyRepository;
        /* @var PartyParticipationRequestFacade $partyParticipationRequestFacade */
        $this->partyParticipationRequestFacade = $partyParticipationRequestFacade;
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

    public function searchParty(string $keyword = null): array
    {
        return $this->service->searchParty($keyword ?? '');
    }


    public function managedParties(string $managerId)
    {
        return $this->partyRepository->findListByManagerId(new StudentNumber($managerId));
    }

    public function officerParties(string $officerId)
    {
        return $this->partyRepository->findListByOfficerId(new StudentNumber($officerId));
    }

    public function partyParticipationRequestSendParties(string $applicantId)
    {
        $sendPartyParticipationRequests = $this->partyParticipationRequestFacade->findStudentNumberPartyParticipationRequestList($applicantId);

        $partyParticipationRequestSendParties = array_map(function(PartyParticipationRequest $partyParticipationRequest) {
            return $this->partyRepository->findById($partyParticipationRequest->partyId());
        }, $sendPartyParticipationRequests);

        return $partyParticipationRequestSendParties;
    }
}
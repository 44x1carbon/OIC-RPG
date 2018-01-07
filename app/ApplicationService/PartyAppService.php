<?php

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use \DateTime;

class PartyAppService
{
    protected $partyRepository;
    protected $partyParticipationRequestRepository;

    function __construct(PartyRepositoryInterface $partyRepository, PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository)
    {
        $this->partyRepository = $partyRepository;
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
    }

    public function registerParty(ActivityEndDate $activityEndDate, StudentNumber $managerId, string $roleName): string
    {
        $partyId = $this->partyRepository->nextId();
        $party = new Party($partyId, $activityEndDate, $managerId);
        $wantedRoleId = $party->addWantedRole($roleName);
        $party->addWantedFrame($wantedRoleId, 1);
        $party->assignMember($wantedRoleId, $managerId);

        $this->partyRepository->save($party);

        return $party->id();
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null)
    {
        $party = $this->partyRepository->findById($partyId);
        $party->editProductionIdea($productionTheme, $productionTypeId, $ideaDescription);

        $this->partyRepository->save($party);

        return $party->id();
    }

    public function addWantedRole(string $partyId, string $roleName, string $jobId = null, string $remarks = null, int $frameAmount)
    {
        $party = $this->partyRepository->findById($partyId);
        $wantedRoleId = $party->addWantedRole($roleName, $jobId, $remarks);
        $party->addWantedFrame($wantedRoleId, $frameAmount);

        $this->partyRepository->save($party);

        return $party->id();
    }

    /** パーティ参加申請 */
    public function registerPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData,
        DateTime $applicationDateData = null,
        Reply $reply = null
    )
    {
        $partyParticipationRequestId = $this->partyParticipationRequestRepository->nextId();
        $applicationDate = $applicationDateData ? new DateTime($applicationDateData) : null;
        $partyParticipationRequest = new PartyParticipationRequest(
                                            $partyParticipationRequestId,
                                            $partyId,
                                            $wantedRoleId,
                                            new StudentNumber($guildMemberIdData),
                                            $applicationDate,
                                            $reply ? new Reply($reply) : null
                                        );

        $this->partyParticipationRequestRepository->save($partyParticipationRequest);

        return $partyParticipationRequest->id();
    }

}
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
    public function sendPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        StudentNumber $guildMemberId,
        DateTime $applicationAtData = null,
        Reply $reply = null
    )
    {
        $partyParticipationRequestId = $this->partyParticipationRequestRepository->nextId();
        $applicationAt = $applicationAtData ? new DateTime($applicationAtData) : null;
        $partyParticipationRequest = new PartyParticipationRequest(
                                            $partyParticipationRequestId,
                                            $partyId,
                                            $wantedRoleId,
                                            $guildMemberId,
                                            $applicationAt ?? null,
                                            $reply ?? null
                                        );

        $this->partyParticipationRequestRepository->save($partyParticipationRequest);

        return $partyParticipationRequest->id();
    }

    public function replyPartyParticipationRequest(string $partyId, StudentNumber $partyManagerId, StudentNumber $guildMemberId, Reply $reply)
    {
        $party = $this->partyRepository->findById($partyId);
        if (!$party->isPartyManagerId($partyManagerId)) throw new \Exception('[ApplicationService] Party Participation Request Reply Error');

        $partyParticipationRequest = $this->partyParticipationRequestRepository->findByPartyIdAndStudentNumber($partyId, $guildMemberId);
        $partyParticipationRequest->setReply($reply);
        $this->partyParticipationRequestRepository->save($partyParticipationRequest);

        return $partyParticipationRequest->id();
    }
}
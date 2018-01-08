<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/15
 * Time: 15:57
 */

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class PartyMemberAppService
{
    protected $factory;
    /* @var PartyRepositoryInterface $partyRepository  */
    protected $partyRepository;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    protected $partyParticipationRequestRepository;

    function __construct(PartyRepositoryInterface $partyRepository, PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository)
    {
        $this->partyRepository = $partyRepository;
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
    }

    public function assignPartyMember(string $partyParticipationRequestId, StudentNumber $partyManagerId)
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
        $party = $this->partyRepository->findById($partyParticipationRequest->partyId());

        if (!$party->partyManagerId()->equals($partyManagerId)) throw new \Exception('[ApplicationService] Party Member Permission Assign Error');
        if ($partyParticipationRequest->reply() ? $partyParticipationRequest->reply()->isRejection() : false) throw new \Exception('[ApplicationService] Party Member Reply Status Assign Error');

        $party->assignMember($partyParticipationRequest->wantedRoleId(), $partyParticipationRequest->guildMemberId());

        return $partyParticipationRequest->guildMemberId();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/19
 * Time: 15:00
 */

namespace App\Presentation;


use App\ApplicationService\PartyAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use \DateTime;

class PartyParticipationRequestFacade
{
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    protected $partyParticipationRequestRepository;
    /* @var PartyAppService $partyAppService */
    protected $partyAppService;

    public function __construct(PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository, PartyAppService $partyAppService)
    {
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
        $this->partyAppService = $partyAppService;
    }

    // パーティ参加申請を作成
    public function registerPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData,
        string $applicationDateData = null,
        string $reply = null
    )
    {
        $partyParticipationRequestId = $this->partyAppService->registerPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), new DateTime($applicationDateData), new Reply($reply));

        return $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
    }

}
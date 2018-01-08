<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/19
 * Time: 15:00
 */

namespace App\Presentation;


use App\ApplicationService\PartyAppService;
use App\ApplicationService\PartyParticipationRequestAppService;
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
        $partyParticipationRequestId = $this->partyAppService->registerPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), $applicationDateData ? new DateTime($applicationDateData) : null, $reply ? new Reply($reply) : null);

        return $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
    }

    // パーティ参加申請に返信
    public function replyPartyParticipationRequest(
        string $partyId,
        string $partyManagerId,
        string $guildMemberId,
        string $replyStatus
    )
    {
        $partyParticipationRequestId = $this->partyAppService->replyPartyParticipationRequest($partyId, new StudentNumber($partyManagerId), new StudentNumber($guildMemberId), new Reply($replyStatus));

        return $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
    }

    // 自分が管理しているパーティの参加申請一覧を取得
    public static function findManagementPartyParticipationRequestList(string $managementId)
    {
        /* @var PartyParticipationRequestAppService $partyParticipationRequestAppService */
        $partyParticipationRequestAppService = app(PartyParticipationRequestAppService::class);

        $partyParticipationRequestList = $partyParticipationRequestAppService->findManagementPartyParticipationRequestList(new StudentNumber($managementId));

        return $partyParticipationRequestList;
    }

    // 自分が申請しているパーティ参加申請一覧を取得
    public static function findStudentNumberPartyParticipationRequestList(string $guildMemberId)
    {
        /* @var PartyParticipationRequestAppService $partyParticipationRequestAppService */
        $partyParticipationRequestAppService = app(PartyParticipationRequestAppService::class);

        return $partyParticipationRequestAppService->findStudentNumberPartyParticipationRequestList(new StudentNumber($guildMemberId));

    }

}
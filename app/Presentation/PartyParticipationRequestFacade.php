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
    /* @var PartyAppService $partyAppService */
    protected $partyAppService;
    /* @var PartyParticipationRequestAppService $partyParticipationRequestAppService */
    protected $partyParticipationRequestAppService;

    public function __construct(PartyAppService $partyAppService, PartyParticipationRequestAppService $partyParticipationRequestAppService)
    {
        $this->partyAppService = $partyAppService;
        $this->partyParticipationRequestAppService = $partyParticipationRequestAppService;
    }

    // パーティ参加申請を作成
    public function sendPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData,
        string $applicationAtData = null,
        string $reply = null
    )
    {
        return $this->partyAppService->sendPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), $applicationAtData ? new DateTime($applicationAtData) : null, $reply ? new Reply($reply) : null);
    }

    // パーティ参加申請に返信
    public function replyPartyParticipationRequest(
        string $partyId,
        string $partyManagerId,
        string $guildMemberId,
        string $replyStatus
    )
    {
        return $this->partyAppService->replyPartyParticipationRequest($partyId, new StudentNumber($partyManagerId), new StudentNumber($guildMemberId), new Reply($replyStatus));
    }

    // 自分が管理しているパーティの参加申請一覧を取得
    public function findManagementPartyParticipationRequestList(string $managementId)
    {
        return $this->partyParticipationRequestAppService->findManagementPartyParticipationRequestList(new StudentNumber($managementId));
    }

    // 自分が申請しているパーティ参加申請一覧を取得
    public function findStudentNumberPartyParticipationRequestList(string $guildMemberId)
    {
        return $this->partyParticipationRequestAppService->findStudentNumberPartyParticipationRequestList(new StudentNumber($guildMemberId));
    }

}
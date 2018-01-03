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
    // パーティ参加申請を作成
    public static function sendPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData,
        string $applicationAtData = null,
        string $reply = null
    )
    {
        $repository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyAppService $partyAppService */
        $partyAppService = app(PartyAppService::class);

        return $partyAppService->sendPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), $applicationAtData ? new DateTime($applicationAtData) : null, $reply ? new Reply($reply) : null);
    }

    // パーティ参加申請に返信
    public static function replyPartyParticipationRequest(
        string $partyId,
        string $partyManagerId,
        string $guildMemberId,
        string $replyStatus
    )
    {
        $repository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyAppService $partyAppService */
        $partyAppService = app(PartyAppService::class);

        return $partyAppService->replyPartyParticipationRequest($partyId, new StudentNumber($partyManagerId), new StudentNumber($guildMemberId), new Reply($replyStatus));
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
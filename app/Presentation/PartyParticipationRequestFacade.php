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
    // パーティ参加申請を作成
    public static function registerPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData,
        string $applicationDateData = null,
        string $reply = null
    )
    {
        $repository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyAppService $partyAppService */
        $partyAppService = app(PartyAppService::class);

        $partyParticipationRequestId = $partyAppService->registerPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), $applicationDateData ? new DateTime($applicationDateData) : null, $reply ? new Reply($reply) : null);

        return $repository->findById($partyParticipationRequestId);
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

        $partyParticipationRequestId = $partyAppService->replyPartyParticipationRequest($partyId, new StudentNumber($partyManagerId), new StudentNumber($guildMemberId), new Reply($replyStatus));

        return $repository->findById($partyParticipationRequestId);
    }

}
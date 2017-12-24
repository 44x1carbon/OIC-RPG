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
        $partyAppService = app(PartyAppService::class);

        $partyParticipationRequestId = $partyAppService->registerPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData), new DateTime($applicationDateData), new Reply($reply));

        return $repository->findById($partyParticipationRequestId);
    }

}
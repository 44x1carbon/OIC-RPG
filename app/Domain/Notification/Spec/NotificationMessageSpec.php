<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 10:51
 */

namespace App\Domain\Notification\ValueObjects;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class NotificationMessageSpec
{
    public static function partyParticipationRequestReception(string $partyParticipationRequestId)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($partyParticipationRequestId);
        /* @var PartyRepositoryInterface $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());
        /* @var GuildMemberRepositoryInterface $guildMemberRepository */
        $guildMemberRepository = app(GuildMemberRepositoryInterface::class);
        /* @var GuildMember $guildMember */
        $guildMember = $guildMemberRepository->findByStudentNumber($partyParticipationRequest->guildMemberId());

        $message = '';
//        var_dump($partyParticipationRequest);
//        var_dump($party->wantedRoles());
//        dd($party->findWantedRoleById($partyParticipationRequest->wantedRoleId()));
        return "あなたが管理している ".$party->productionIdea()->productionTheme()." パーティに ".$guildMember->studentName()." さんから ".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()." に参加申請が来ています。\n";
    }

    public static function partyParticipationRequestReply(string $partyParticipationRequestId)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($partyParticipationRequestId);
        /* @var PartyRepositoryInterface $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());

        $message = $party->productionIdea()->productionTheme()." パーティの ".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()." への参加については、\n";
        if ($partyParticipationRequest->reply()->isPermit()) {
            $message = $message."参加が承認されました！おめでとうございます！";
        } elseif ($partyParticipationRequest->reply()->isRejection()) {
            $message = $message."参加が拒否されました。今後ますますのご健闘をお祈り申し上げます。";
        }
        return $message;
    }
}
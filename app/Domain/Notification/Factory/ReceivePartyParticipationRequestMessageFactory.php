<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 13:46
 */

namespace App\Domain\Notification\Factory;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class ReceivePartyParticipationRequestMessageFactory implements NotificationMessageFactoryInterface
{
    public function createTitle(string $id)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($id);
        /* @var $partyRepository $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());

        return $party->productionIdea()->productionTheme()."パーティに参加申請が来ています。";
    }

    public function createMessage(string $id)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($id);
        /* @var PartyRepositoryInterface $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());
        /* @var GuildMemberRepositoryInterface $guildMemberRepository */
        $guildMemberRepository = app(GuildMemberRepositoryInterface::class);
        /* @var GuildMember $guildMember */
        $guildMember = $guildMemberRepository->findByStudentNumber($partyParticipationRequest->guildMemberId());

        return "あなたが管理している ".$party->productionIdea()->productionTheme()." パーティに ".$guildMember->studentName()." さんから ".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()." に参加申請が来ています。\n";
    }

}
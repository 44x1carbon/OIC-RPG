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

class ReceivePartyParticipationRequestTextFactory implements NotificationTextFactoryInterface
{
    public function createTitle(string $id): string
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($id);
        /* @var $partyRepository $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());

        return "「".$party->productionIdea()->productionTheme()."」へ参加申請が来ています。";
    }

    public function createMessage(string $id): string
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

        return "あなたが管理している「 ".$party->productionIdea()->productionTheme()." 」の\n「".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()." 」に\n ".$guildMember->studentName()." さんから参加申請が来ています。";
    }

}
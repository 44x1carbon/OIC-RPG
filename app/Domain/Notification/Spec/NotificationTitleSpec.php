<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 10:51
 */

namespace App\Domain\Notification\ValueObjects;

use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class NotificationTitleSpec
{
    public static function partyParticipationRequestReception(string $partyParticipationRequestId)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($partyParticipationRequestId);
        /* @var $partyRepository $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());

        return $party->productionIdea()->productionTheme()."パーティに参加申請が来ています";
    }

    public static function partyParticipationRequestReply(string $partyParticipationRequestId)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
        $partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        /* @var PartyParticipationRequest $partyParticipation */
        $partyParticipationRequest = $partyParticipationRequestRepository->findById($partyParticipationRequestId);
        /* @var $partyRepository $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($partyParticipationRequest->partyId());

        return $party->productionIdea()->productionTheme()."パーティへ送った参加申請の返信が来ています";
    }
}
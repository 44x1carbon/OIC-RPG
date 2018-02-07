<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 13:47
 */

namespace App\Domain\Notification\Factory;

use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class ReplyPartyParticipationRequestMessageFactory implements NotificationMessageFactoryInterface
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

        return $party->productionIdea()->productionTheme()."パーティへ送った参加申請の返信が来ています";
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

        $message = $party->productionIdea()->productionTheme()." パーティの ".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()." への参加については、\n";
        if ($partyParticipationRequest->reply()->isPermit()) {
            $message = $message."参加が承認されました！おめでとうございます！";
        } elseif ($partyParticipationRequest->reply()->isRejection()) {
            $message = $message."参加が拒否されました。今後ますますのご健闘をお祈り申し上げます。";
        }
        return $message;
    }
}
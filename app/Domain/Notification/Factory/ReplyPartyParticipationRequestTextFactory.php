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

class ReplyPartyParticipationRequestTextFactory implements NotificationTextFactoryInterface
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

        return "「".$party->productionIdea()->productionTheme()."」参加申請の返信が来ています。";
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

        $message = "あなたが申請を送った「".$party->productionIdea()->productionTheme()."」の「".$party->findWantedRoleById($partyParticipationRequest->wantedRoleId())->roleName()."」への参加申請は、\n";
        if ($partyParticipationRequest->reply()->isPermit()) {
            $message = $message."無事、承認されました！おめでとうございます！";
        } elseif ($partyParticipationRequest->reply()->isRejection()) {
            $message = $message."残念ですが、拒否されました。今後ますますのご健闘をお祈り申し上げます。";
        }
        return $message;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 12:47
 */

namespace App\Domain\Notification\Factory;


use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use App\Domain\Notification\ValueObjects\NotificationType;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class NotificationFactory
{
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    private $partyParticipationRequestRepository;
    /* @var NotificationRepositoryInterface $notificationRepository */
    private $notificationRepository;
    /* @var PartyRepositoryInterface $partyRepository */
    private $partyRepository;
    /* @var ReceivePartyParticipationRequestMessageFactory $receivePartyParticipationRequestMessageFactory */
    private $receivePartyParticipationRequestMessageFactory;
    /* @var ReplyPartyParticipationRequestMessageFactory $replyPartyParticipationRequestMessageFactory */
    private $replyPartyParticipationRequestMessageFactory;

    public function __construct(
        PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository,
        NotificationRepositoryInterface $notificationRepository,
        PartyRepositoryInterface $partyRepository,
        ReceivePartyParticipationRequestMessageFactory $receivePartyParticipationRequestMessageFactory,
        ReplyPartyParticipationRequestMessageFactory $replyPartyParticipationRequestMessageFactory
    )
    {
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
        $this->notificationRepository = $notificationRepository;
        $this->partyRepository = $partyRepository;
        $this->receivePartyParticipationRequestMessageFactory = $receivePartyParticipationRequestMessageFactory;
        $this->replyPartyParticipationRequestMessageFactory = $replyPartyParticipationRequestMessageFactory;
    }

    /**
     * 自分の管理しているパーティに参加申請が送られた場合の通知を作成
     *
     * @param string $partyParticipationRequestId
     * @return Notification
     */
    public function receivePartyParticipationRequestNotification(string $partyParticipationRequestId)
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
        $party = $this->partyRepository->findById($partyParticipationRequest->partyId());

        $notification = new Notification(
            $this->notificationRepository->nextId(),
            $this->receivePartyParticipationRequestMessageFactory->createTitle($partyParticipationRequestId),
            $this->receivePartyParticipationRequestMessageFactory->createMessage($partyParticipationRequestId),
            $party->partyManagerId(),
            new Link($partyParticipationRequestId, LinkType::PARTY_PARTICIPATION_REQUEST()),
            NotificationType::RECEIVE_PARTY_PARTICIPATION_REQUEST()
        );
        return $notification;
    }

    /**
     * 自分の送信した参加申請への返信が帰ってきた場合の通知を作成
     *
     * @param string $partyParticipationRequestId
     * @return Notification
     */
    public function replyPartyParticipationRequestNotification(string $partyParticipationRequestId)
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
        $party = $this->partyRepository->findById($partyParticipationRequest->partyId());

        $notification = new Notification(
            $this->notificationRepository->nextId(),
            $this->replyPartyParticipationRequestMessageFactory->createTitle($partyParticipationRequestId),
            $this->replyPartyParticipationRequestMessageFactory->createMessage($partyParticipationRequestId),
            $partyParticipationRequest->guildMemberId(),
            new Link($partyParticipationRequestId, LinkType::PARTY_PARTICIPATION_REQUEST()),
            NotificationType::REPLY_PARTY_PARTICIPATION_REQUEST()
        );
        return $notification;
    }

}
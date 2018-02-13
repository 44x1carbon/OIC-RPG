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
    /* @var ReceivePartyParticipationRequestTextFactory $receivePartyParticipationRequestTextFactory */
    private $receivePartyParticipationRequestTextFactory;
    /* @var ReplyPartyParticipationRequestTextFactory $replyPartyParticipationRequestTextFactory */
    private $replyPartyParticipationRequestTextFactory;

    public function __construct(
        PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository,
        NotificationRepositoryInterface $notificationRepository,
        PartyRepositoryInterface $partyRepository,
        ReceivePartyParticipationRequestTextFactory $receivePartyParticipationRequestTextFactory,
        ReplyPartyParticipationRequestTextFactory $replyPartyParticipationRequestTextFactory
    )
    {
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
        $this->notificationRepository = $notificationRepository;
        $this->partyRepository = $partyRepository;
        $this->receivePartyParticipationRequestTextFactory = $receivePartyParticipationRequestTextFactory;
        $this->replyPartyParticipationRequestTextFactory = $replyPartyParticipationRequestTextFactory;
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
            $this->receivePartyParticipationRequestTextFactory->createTitle($partyParticipationRequestId),
            $this->receivePartyParticipationRequestTextFactory->createMessage($partyParticipationRequestId),
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
            $this->replyPartyParticipationRequestTextFactory->createTitle($partyParticipationRequestId),
            $this->replyPartyParticipationRequestTextFactory->createMessage($partyParticipationRequestId),
            $partyParticipationRequest->guildMemberId(),
            new Link($partyParticipationRequest->partyId(), LinkType::PARTY()),
            NotificationType::REPLY_PARTY_PARTICIPATION_REQUEST()
        );
        return $notification;
    }

}
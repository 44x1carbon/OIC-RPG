<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 12:29
 */

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use App\Domain\Notification\ValueObjects\NotificationMessageSpec;
use App\Domain\Notification\ValueObjects\NotificationTitleSpec;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class NotificationAppService
{
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    private $partyParticipationRequestRepository;
    /* @var NotificationRepositoryInterface $notificationRepository */
    private $notificationRepository;
    /* @var PartyRepositoryInterface $partyRepository */
    private $partyRepository;

    public function __construct(
        PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository,
        NotificationRepositoryInterface $notificationRepository,
        PartyRepositoryInterface $partyRepository
    )
    {
        $this->partyParticipationRequestRepository  = $partyParticipationRequestRepository;
        $this->notificationRepository = $notificationRepository;
        $this->partyRepository = $partyRepository;
    }

    /**
     * パーティへ参加申請があった場合に通知を作成
     */
    public function sendPartyParticipationRequestReception (string $partyParticipationRequestId)
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
        $party = $this->partyRepository->findById($partyParticipationRequest->partyId());

        $notification = new Notification(
                                $this->notificationRepository->nextId(),
                                NotificationTitleSpec::partyParticipationRequestReception($partyParticipationRequestId),
                                NotificationMessageSpec::partyParticipationRequestReception($partyParticipationRequestId),
                                $party->partyManagerId(),
                                new Link($partyParticipationRequestId, LinkType::PARTY_PARTICIPATION_REQUEST())
                            );

        $this->notificationRepository->save($notification);

        return $notification->id();
    }

    /**
     * 送ったパーティ参加申請への返信の通知する
     */
    public function sendPartyParticipationRequestReply(string $partyParticipationRequestId)
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($partyParticipationRequestId);
        $notification = new Notification(
                                $this->notificationRepository->nextId(),
                                NotificationTitleSpec::partyParticipationRequestReply($partyParticipationRequestId),
                                NotificationMessageSpec::partyParticipationRequestReply($partyParticipationRequestId),
                                $partyParticipationRequest->guildMemberId(),
                                new Link($partyParticipationRequestId, LinkType::PARTY_PARTICIPATION_REQUEST())
                            );
        $this->notificationRepository->save($notification);

        return $notification->id();
    }

    /**
     * 通知を既読にする
     */
    public function readNotification(string $notificationId)
    {
        $notification = $this->notificationRepository->findById($notificationId);
        $notification->reading();
        $this->notificationRepository->save($notification);

        return $notification->id();
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 12:29
 */

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\Factory\NotificationFactory;
use App\Domain\Notification\Factory\ScoutNotificationFactory;
use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Notification\Spec\NotificationSpec;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\Scout\Scout;
use App\Eloquents\NotificationEloquent;
use Exception;

class NotificationAppService
{
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    private $partyParticipationRequestRepository;
    /* @var NotificationRepositoryInterface $notificationRepository */
    private $notificationRepository;
    /* @var NotificationFactory $notificationFactory */
    private $notificationFactory;
    /* @var NotificationSpec $notificationSpec */
    private $notificationSpec;

    public function __construct(
        PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository,
        NotificationRepositoryInterface $notificationRepository,
        NotificationFactory $notificationFactory,
        NotificationSpec $notificationSpec
    )
    {
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
        $this->notificationRepository = $notificationRepository;
        $this->notificationFactory = $notificationFactory;
        $this->notificationSpec = $notificationSpec;
    }

    /**
     * パーティへ参加申請があった場合に通知を作成
     */
    public function sendPartyParticipationRequestReception (string $partyParticipationRequestId)
    {

        $notification = $this->notificationFactory->receivePartyParticipationRequestNotification($partyParticipationRequestId);

        $this->notificationRepository->save($notification);

        return $notification->id();
    }

    /**
     * 送ったパーティ参加申請への返信の通知する
     */
    public function sendPartyParticipationRequestReply(string $partyParticipationRequestId)
    {

        $notification = $this->notificationFactory->replyPartyParticipationRequestNotification($partyParticipationRequestId);

        $this->notificationRepository->save($notification);

        return $notification->id();
    }

    public function sendScoutNotification(Scout $scout)
    {
        $notification = (new ScoutNotificationFactory($scout))->build();
        $this->notificationRepository->save($notification);
        return $notification->id();
    }

    /**
     * 通知IDを元に取得する
     */
    public function notification(StudentNumber $studentNumber, string $notificationId)
    {
        $notification = $this->notificationRepository->findById($notificationId);

        // notificationが引数で受け取ったstudentNumber宛のものか判定
        if (!$this->notificationSpec::isNotificationToStudentNumber($studentNumber, $notification)) throw new Exception('存在しない通知IDです。');

        return $notification;
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
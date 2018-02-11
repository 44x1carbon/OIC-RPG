<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/11
 * Time: 15:07
 */

namespace App\Domain\Notification\Spec;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;

class NotificationSpec
{
    /**
     * 未読の通知があるかどうか
     * @return bool
     */
    public static function hasUnreadNotifications(StudentNumber $studentNumber): bool
    {
        /* @var NotificationRepositoryInterface $notificationRepository */
        $notificationRepository = app(NotificationRepositoryInterface::class);
        $notificationList = $notificationRepository->findUnreadListByStudentNumber($studentNumber);

        return count($notificationList) > 0;
    }
}
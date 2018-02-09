<?php

namespace App\Http\Controllers;

use App\ApplicationService\NotificationAppService;
use App\Domain\GuildMember\GuildMember;
use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Infrastracture\Notification\NotificationViewModel;

class NotificationController extends Controller
{
    /**
     * 通知の一覧
     */
    public function index(
        NotificationRepositoryInterface $notificationRepository,
        GuildMember $loginMember
    )
    {
        $notifications = $notificationRepository->findListByStudentNumber($loginMember->studentNumber());

        $notificationViewModels = array_map(function(Notification $notification) {
            return new NotificationViewModel($notification);
        }, $notifications);

        // 新しい通知が上に来るようにソート
        usort($notificationViewModels, function ($notification1, $notification2)
        {
            return $notification2->notificationAt() <=> $notification1->notificationAt();
        });

        return view('Notification.Index')->with('notifications', $notificationViewModels);
    }

    /**
     * 通知の詳細
     */
    public function detail(
        NotificationAppService $notificationAppService,
        string $notificationId,
        GuildMember $loginMember
    )
    {
        $notification = $notificationAppService->notification($loginMember->studentNumber(), $notificationId);

        // 開いた通知を既読にする
        $notificationAppService->readNotification($notificationId);

        // 自分宛の通知か判定
        return view('Notification.Detail')
            ->with('notification', new NotificationViewModel($notification));
    }
}

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

        // 自分宛の通知か判定
        return view('Notification.Detail')
            ->with('notification', new NotificationViewModel($notification));
    }
}

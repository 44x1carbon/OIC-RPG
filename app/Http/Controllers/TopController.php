<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 13:51
 */

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class TopController extends Controller
{
    // Top画面
    public function index(
        GuildMember $loginMember,
        NotificationRepositoryInterface $notificationRepository
    )
    {
        return view('Top')
            ->with('guildMember', new GuildMemberViewModel($loginMember))
            ->with('sendNotification', $notificationRepository->hasUnreadNotifications($loginMember->studentNumber()));
    }
}
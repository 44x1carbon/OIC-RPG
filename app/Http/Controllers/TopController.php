<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 13:51
 */

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\Notification\Spec\NotificationSpec;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class TopController extends Controller
{
    // Top画面
    public function index(
        GuildMember $loginMember,
        NotificationSpec $notificationSpec
    )
    {
        return view('Top')
            ->with('guildMember', new GuildMemberViewModel($loginMember))
            ->with('sendNotification', $notificationSpec::hasUnreadNotifications($loginMember->studentNumber()));
    }
}
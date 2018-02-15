<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 13:51
 */

namespace App\Http\Controllers;

use App\ApplicationService\FeedAppService;
use App\Domain\Feed\Feed;
use App\Domain\GuildMember\GuildMember;
use App\Infrastracture\Feed\FeedViewModel;
use App\Domain\Notification\Spec\NotificationSpec;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class TopController extends Controller
{
    // Top画面
    public function index(
        GuildMember $loginMember,
        FeedAppService $feedAppService,
        NotificationSpec $notificationSpec
    )
    {
        // 最新のFeedを取得
        $feedList = $feedAppService->feed();
        $feedViewModelList = array_map(function(Feed $feed) {
            return new FeedViewModel($feed);
        }, $feedList);

        return view('Top')
            ->with('guildMember', new GuildMemberViewModel($loginMember))
            ->with('sendNotification', $notificationSpec::hasUnreadNotifications($loginMember->studentNumber()))
            ->with('feedList', $feedViewModelList);
    }
}
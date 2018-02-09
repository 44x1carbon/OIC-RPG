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
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Infrastracture\Feed\FeedViewModel;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class TopController extends Controller
{
    // Top画面
    public function index(
        GuildMember $loginMember,
        NotificationRepositoryInterface $notificationRepository,
        FeedAppService $feedAppService
    )
    {
        // 最新のFeedを取得
        $feedList = $feedAppService->feed();
        $feedViewModelList = array_map(function(Feed $feed) {
            return new FeedViewModel($feed);
        }, $feedList);

        return view('Top')
            ->with('guildMember', new GuildMemberViewModel($loginMember))
            ->with('sendNotification', $notificationRepository->hasUnreadNotifications($loginMember->studentNumber()))
            ->with('feedList', $feedViewModelList);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 1:12
 */

namespace App\Infrastracture\Notification;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\Notification;
use App\Domain\Notification\ValueObjects\NotificationType;
use App\Infrastracture\Link\LinkViewModel;
use DateTime;

class NotificationViewModel
{
    private $notification;
    private $title = null;             // 通知タイトル
    private $message = null;           // 通知メッセージ
    private $toStudentNumber = null;   // 通知先学籍番号
    private $link = null;              // リンクVO
    private $notificationType = null;  // 通知種類
    private $notificationAt = null;    // 通知日時
    private $readFlg = null;           // 既読フラグ

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
        $this->id = $notification->id();
        $this->title = $notification->title();
        $this->message = $this->saftyNl2Br($notification->message());
        $this->toStudentNumber = $notification->toStudentNumber();
        $this->link = new LinkViewModel($notification->link());
        $this->notificationType = $notification->notificationType();
        $this->notificationAt = $notification->notificationAt();
        $this->readFlg = $notification->isRead();
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * 通知先のギルドメンバーの学籍番号
     * @return StudentNumber
     */
    public function toStudentNumber(): StudentNumber
    {
        return $this->toStudentNumber;
    }

    /**
     * @return LinkViewModel
     */
    public function link(): LinkViewModel
    {
        return $this->link;
    }

    /**
     * 通知種類
     * @return NotificationType
     */
    public function notificationType(): NotificationType
    {
        return $this->notificationType;
    }

    /**
     * 通知日時
     * @return \DateTime
     */
    public function notificationAt(): DateTime
    {
        return $this->notificationAt;
    }

    /**
     * 既読かどうか
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->readFlg;
    }

    /**
     * 未読かどうか
     * @return bool
     */
    public function isUnread(): bool
    {
        return !$this->readFlg;
    }

    private function saftyNl2Br(string $text): string
    {
        return nl2br(htmlspecialchars($text));
    }
}
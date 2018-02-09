<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/30
 * Time: 13:32
 */

namespace App\Domain\Notification;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\NotificationType;
use Carbon\Carbon;
use \DateTime;

class Notification
{
    private $title;             // 通知タイトル
    private $message;           // 通知メッセージ
    private $toStudentNumber;   // 通知先学籍番号
    private $link;              // リンクVO
    private $notificationType;  // 通知種類
    private $notificationAt;    // 通知日時
    private $readFlg;           // 既読フラグ

    public function __construct(
        string $id,
        string $title,
        string $message,
        StudentNumber $toStudentNumber,
        Link $link = null,
        NotificationType $notificationType,
        \DateTime $notificationAt = null,
        bool $readFlg = false
        )
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->toStudentNumber = $toStudentNumber;
        $this->link = $link;
        $this->notificationType = $notificationType;
        $this->notificationAt = $notificationAt ?? Carbon::now();
        $this->readFlg = $readFlg;
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
     * @return Link
     */
    public function link(): Link
    {
        return $this->link;
    }

    /**
     * 通知の種類
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

    /**
     * 既読にする
     */
    public function reading(): void
    {
        $this->readFlg = true;
    }

}
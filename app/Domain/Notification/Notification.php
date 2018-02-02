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
use Carbon\Carbon;

class Notification
{
    private $title;             // 通知タイトル
    private $message;           // 通知メッセージ
    private $toStudentNumber;   // 通知先学籍番号
    private $notificationAt;    // 通知日時
    private $link;              // リンクVO
    private $readFlg;           // 既読フラグ

    public function __construct(
        string $id,
        string $title,
        string $message,
        StudentNumber $toStudentNumber,
        Link $link = null,
        \DateTime $notificationAt = null,
        bool $readFlg = false
        )
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->toStudentNumber = $toStudentNumber;
        $this->link = $link;
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
     * @return \DateTime
     */
    public function notificationAt()
    {
        return $this->notificationAt;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->readFlg;
    }

    /**
     * 既読にする
     */
    public function reading(): void
    {
        $this->readFlg = true;
    }

}
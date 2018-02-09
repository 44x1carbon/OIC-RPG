<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class NotificationEloquent extends Model
{
    protected $table = 'notifications';

    public static function findById(string $id): ?NotificationEloquent
    {
        $notificationModel = self::where('notification_id', $id)->first();
        return $notificationModel;
    }

    /**
     * 学籍番号を指定して、通知のリストを取得する
     * @param StudentNumber $studentNumber
     * @return NotificationEloquent[]
     */
    public static function findListByStudentNumber(StudentNumber $studentNumber): Collection
    {
        $notificationModels = self::where('to_student_number', $studentNumber->code())->get();
        return $notificationModels;
    }

    /**
     * 学籍番号を指定して、未読の通知がある場合取得する
     * @param StudentNumber $studentNumber
     * @return NotificationEloquent[]
     */
    public static function findListByStudentNumberUnread(StudentNumber $studentNumber): Collection
    {
        $unreadNotificationModels = self::where('to_student_number', $studentNumber->code())->where('read_flg', false)->get();
        return $unreadNotificationModels;
    }

    public static function fromEntity(Notification $notification): NotificationEloquent
    {
        $notificationModel = self::findById($notification->id());
        if(is_null($notificationModel))
        {
            $notificationModel = new notificationEloquent();
            $notificationModel->notification_id = $notification->id();
        }
        $notificationModel->title               = $notification->title();
        $notificationModel->message             = $notification->message();
        $notificationModel->to_student_number   = $notification->toStudentNumber()->code();
        $notificationModel->notification_at     = $notification->notificationAt();
        $notificationModel->read_flg            = $notification->isRead();
        $notificationModel->link_id             = LinkEloquent::fromVo($notification->link())->id;

        return $notificationModel;
    }

    public function toEntity(): Notification
    {
        $linkEloquent = LinkEloquent::findById($this->link_id);

        $entity = new Notification(
            $this->notification_id,
            $this->title,
            $this->message,
            new StudentNumber($this->to_student_number),
            $linkEloquent->toVo(),
            new \DateTime($this->notification_at),
            $this->read_flg
        );

        return $entity;
    }

    public static function saveDomainObject(Notification $notification)
    {
        $notificationModel = self::fromEntity($notification);

        $notificationModel->link_id = LinkEloquent::saveDomainObject($notification->link());

        $notificationModel->save();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 15:26
 */

namespace App\Infrastracture\Notification;

use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\NotificationEloquent;

class NotificationEloquentRepositoryImpl implements NotificationRepositoryInterface
{
    /* @var NotificationEloquent $notificationEloquent */
    protected $notificationEloquent;

    public function __construct(NotificationEloquent $notificationEloquent)
    {
        $this->notificationEloquent = $notificationEloquent;
    }

    public function findById(string $code): ?Notification
    {
        $notificationModel = $this->notificationEloquent->findById($code);
        if(is_null($notificationModel)) return null;
        return $notificationModel->toEntity();
    }

    public function nextId(): string
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null($this->notificationEloquent->findById($randId)));

        return $randId;
    }

    public function save(Notification $notification): bool
    {
        $this->notificationEloquent->saveDomainObject($notification);
        return true;
    }

    public function all(): array
    {
        $notificationModels = $this->notificationEloquent->all();

        $notificationCollection = $notificationModels->map(function(NotificationEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $notificationCollection->toArray();
    }

}
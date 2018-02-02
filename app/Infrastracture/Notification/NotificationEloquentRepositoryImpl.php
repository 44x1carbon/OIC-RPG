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
    public function findById(string $code): ?Notification
    {
        $notificationModel = NotificationEloquent::findById($code);
        if(is_null($notificationModel)) return null;
        return $notificationModel->toEntity();
    }

    public function nextId(): string
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null(notificationEloquent::findById($randId)));

        return $randId;
    }

    public function save(Notification $notification): bool
    {
        NotificationEloquent::saveDomainObject($notification);
        return true;
    }

    public function all(): array
    {
        $notificationModels = NotificationEloquent::all();

        $notificationCollection = $notificationModels->map(function(NotificationEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $notificationCollection->toArray();
    }

}
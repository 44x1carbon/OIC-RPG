<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 15:21
 */

namespace App\Domain\Notification\RepositoryInterface;


use App\Domain\Notification\Notification;

interface NotificationRepositoryInterface
{
    public function findById(string $code): ?Notification;

    public function nextId(): string;

    public function save(Notification $notification): bool;

    public function all(): array;
}
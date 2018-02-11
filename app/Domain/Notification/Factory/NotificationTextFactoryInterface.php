<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 13:38
 */

namespace App\Domain\Notification\Factory;

interface NotificationTextFactoryInterface
{
    public function createTitle(string $id): string;

    public function createMessage(string $id): string;
}
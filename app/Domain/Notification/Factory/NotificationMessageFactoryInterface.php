<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 13:38
 */

namespace App\Domain\Notification\Factory;

interface NotificationMessageFactoryInterface
{
    public function createTitle(string $id);

    public function createMessage(string $id);
}
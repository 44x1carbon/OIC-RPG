<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 8:27
 */

namespace App\Domain\Event;


use App\Domain\Event\ValueObjects\EventId;

interface EventRepositoryInterface
{
    public function save(Event $event): bool;

    public function all(): array;

    public function findById(string $code): ?Event;

    public function nextId(): EventId;
}
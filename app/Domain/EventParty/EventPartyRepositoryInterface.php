<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 3:57
 */

namespace App\Domain\EventParty;


use App\Domain\Event\ValueObjects\EventId;

interface EventPartyRepositoryInterface
{
    public function save(EventParty $eventParty): bool;

    public function findByEventId(EventId $id): array;

    public function findByEventIdAndPartyId(EventId $eventId, string $partyId): ?EventParty;

    public function allEventPartyRankingOrderByAsc(EventId $eventId): array;
}
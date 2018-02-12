<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 5:40
 */

namespace App\Domain\EventParty\Spec;


use App\Domain\Event\ValueObjects\EventId;
use App\Domain\EventParty\EventPartyRepositoryInterface;
use App\DomainUtility\SpecTrait;

class EventPartySpec
{
    use SpecTrait;

    public static function isExist(EventId $eventId, string $partyId)
    {
        /* @var EventPartyRepositoryInterface $repo */
        $repo = app(EventPartyRepositoryInterface::class);
        return(!is_null($repo->findByEventIdAndPartyId($eventId, $partyId)));
    }
}
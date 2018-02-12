<?php

use App\Domain\Event\ValueObjects\EventId;
use App\Domain\EventParty\EventParty;
use App\Domain\EventParty\EventPartyRepositoryInterface;
use App\Domain\EventParty\Spec\EventPartySpec;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 7:34
 */


class EventPartySpecTest extends TestCase
{
    /* @var EventPartyRepositoryInterface $repo */
    protected $repo;
    /* @var EventParty $eventParty */
    private $eventParty;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(EventPartyRepositoryInterface::class);

        $this->eventParty = new EventParty(
            new EventId('aaaa'),
            'bbbb'
        );
        $this->repo->save($this->eventParty);
    }

    public function testIsExist()
    {
        $this->assertTrue(EventPartySpec::isExist($this->eventParty->eventId(), $this->eventParty->partyId()));
        $this->assertFalse(EventPartySpec::isExist(new EventId('bbbb'), 'aaaa'));
    }
}

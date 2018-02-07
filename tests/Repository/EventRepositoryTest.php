<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 9:23
 */

namespace Tests\Repository;


use App\Domain\Event\Event;
use App\Domain\Event\EventRepositoryInterface;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use App\Infrastracture\Event\EventEloquentRepositoryImpl;
use Tests\TestCase;

class EventRepositoryTest extends TestCase
{
    /* @var EventEloquentRepositoryImpl $repo */
    protected $repo;
    /* @var Event $event */
    private $event;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(EventRepositoryInterface::class);

        $this->event = new Event(
            new EventId('aaaa'),
            'MF',
            'oic',
            '作品展',
            new ReleasePeriod(new \DateTime('2018-01-01'), new \DateTime('2018-02-01')),
            new EventHoldPeriod(new \DateTime('2018-01-02'), new \DateTime('2018-01-15')),
            new EvaluationPeriod(new \DateTime('2018-01-16'), new \DateTime('2018-01-30'))
        );

        $this->repo->save($this->event);
    }

    public function testSave()
    {
        $this->assertTrue($this->repo->save($this->event));
    }

    public function testFindById()
    {
        $result = $this->repo->findById($this->event->id());
        $this->assertTrue($result->id()->code() === $this->event->id()->code());
    }

    public function testNextId()
    {
        $nextId = $this->repo->nextId();
        $this->assertTrue(is_null($this->repo->findById($nextId)));
    }

    public function testAll()
    {
        $registerEventIds[] = $this->event->id()->code();
        $getEventIds = [];
        /* @var Event $e */
        foreach ($this->repo->all() as $e)
        {
            $getEventIds[] = $e->id()->code();
        }
        $this->assertTrue(empty(array_diff($getEventIds, $registerEventIds)));
    }
}

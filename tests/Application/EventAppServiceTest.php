<?php

use App\ApplicationService\EventAppService;
use App\Domain\Event\EventRepositoryInterface;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use App\Domain\EventParty\EventParty;
use App\Domain\EventParty\EventPartyRepositoryInterface;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 11:07
 */


class EventAppServiceTest extends TestCase
{
    /* @var EventRepositoryInterface $repo */
    protected $repo;
    /* @var EventPartyRepositoryInterface $eventPartyRepo */
    protected $eventPartyRepo;
    /* @var EventAppService $appService */
    protected $appService;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(EventRepositoryInterface::class);
        $this->eventPartyRepo = app(EventPartyRepositoryInterface::class);
        $this->appService = app(EventAppService::class);
    }

    public function testIssueEventSuccess()
    {
        $id = $this->appService->issueEvent(
            'MF',
            'oic',
            '作品展',
            new ReleasePeriod(new \DateTime('2019-01-01'), new \DateTime('2019-02-01')),
            new EventHoldPeriod(new \DateTime('2019-01-02'), new \DateTime('2019-01-15')),
            new EvaluationPeriod(new \DateTime('2019-01-16'), new \DateTime('2019-01-30'))
        );
        $result = $this->repo->findById($id);
        $this->assertTrue(isset($result));
    }

    /**
     * @expectedException Exception
     */
    public function testIssueEventFail()
    {
        $id = $this->appService->issueEvent(
            'MF',
            'oic',
            '作品展',
            new ReleasePeriod(new \DateTime('2018-01-01'), new \DateTime('2018-02-01')),
            new EventHoldPeriod(new \DateTime('2019-01-02'), new \DateTime('2019-01-15')),
            new EvaluationPeriod(new \DateTime('2020-01-16'), new \DateTime('2020-01-30'))
        );
    }

    public function testRanking()
    {
        $eventId = new EventId('aaaa');
        $partyId = 'bbbb';
        $rank = 1;

        $this->eventPartyRepo->save(new EventParty($eventId, $partyId));

        $this->appService->ranking($eventId, $partyId, $rank);

        $result = $this->eventPartyRepo->findByEventIdAndPartyId($eventId, $partyId);

        $this->assertTrue($result->rank() === $rank);
    }
}

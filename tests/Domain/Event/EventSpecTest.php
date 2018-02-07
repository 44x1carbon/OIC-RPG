<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 6:13
 */

namespace tests\Domain\Event;


use App\Domain\Event\Event;
use App\Domain\Event\Spec\EventSpec;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use Carbon\Carbon;
use Tests\TestCase;

class EventSpecTest extends TestCase
{
    /* @var Event $event */
    private $event;

    public function setUp()
    {
        parent::setUp();

        $id = new EventId('aaaa');
        $name = 'MF';
        $theme = 'oic';
        $description = '作品展';
        $releasePeriod = new ReleasePeriod(new \DateTime('2018-01-01'), new \DateTime('2018-02-01'));
        $eventHoldPeriod = new EventHoldPeriod(new \DateTime('2018-01-02'), new \DateTime('2018-01-15'));
        $evaluationPeriod = new EvaluationPeriod(new \DateTime('2018-01-16'), new \DateTime('2018-01-30'));

        $this->event = new Event(
            $id,
            $name,
            $theme,
            $description,
            $releasePeriod,
            $eventHoldPeriod,
            $evaluationPeriod
        );
    }

    public function testSuccess()
    {
        $this->assertTrue(EventSpec::allValidate($this->event));
    }

    public function testValidateWhetherWithinReleasePeriod()
    {
        $flag = true;
        $date = new Carbon($this->event->eventHoldPeriod()->startDate()->format('Y-m-d'));
        $interval = $this->event->releasePeriod()->endDate()->diff($this->event->releasePeriod()->startDate());

        for ($i = 0; $i < $interval->days; $i++)
        {
            if(!EventSpec::validateWhetherWithinReleasePeriod(
                $this->event->releasePeriod(),
                new \DateTime($date))
            ){$flag = false; break;}
            $date = $date->addDay();
        }

        $this->assertTrue($flag);
    }

    public function testFailValidateWhetherWithinReleasePeriod()
    {
        $this->assertFalse(EventSpec::validateWhetherWithinReleasePeriod(
            $this->event->releasePeriod(),
            new \DateTime('2018-02-02')
        ));
    }

    public function testValidateEndedEventHoldPeriod()
    {
        $this->assertTrue(EventSpec::validateEndedEventHoldPeriod(
            $this->event->eventHoldPeriod(),
            $this->event->evaluationPeriod()
        ));
    }

    public function testFailValidateEndedEventHoldPeriod()
    {
        $this->assertFalse(EventSpec::validateEndedEventHoldPeriod(
            $this->event->eventHoldPeriod(),
            new EvaluationPeriod(new \DateTime('2018-01-15'), new \DateTime('2018-01-31'))
        ));
    }
}

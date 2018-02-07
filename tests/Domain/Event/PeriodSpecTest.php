<?php

namespace tests\Domain\Event;

use App\Domain\Event\Spec\PeriodSpec;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use DateTime;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/02
 * Time: 17:15
 */


class PeriodSpecTest extends TestCase
{
    private $start;
    private $late;
    private $period;

    public function setUp()
    {
        parent::setUp();
        $this->start = new DateTime('2019-01-01');
        $this->late = new DateTime('2020-01-01');
        $this->period = new ReleasePeriod($this->start, $this->late);
    }

    public function testSuccess()
    {
        $this->assertTrue(PeriodSpec::allValidate($this->period));
    }

    public function testIsAfterNow()
    {
        $old = new DateTime('2000-01-01');
        $this->assertFalse(PeriodSpec::isAfterNow($old));
        $this->assertTrue(PeriodSpec::isAfterNow($this->late));
    }

    public function testIsAfterStartDate()
    {
        $this->assertTrue(PeriodSpec::isAfterStartDate($this->start, $this->late));
        $this->assertFalse(PeriodSpec::isAfterStartDate($this->late, $this->start));
    }
}

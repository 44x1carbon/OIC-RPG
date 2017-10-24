<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 16:03
 */

 namespace tests\Domain\ActivityPeriod;

 use App\Domain\Party\Spec\ActivityPeriodSpec;
 use App\Domain\Party\ValueObjects\ActivityPeriod;
 use Tests\TestCase;


class ActivityPeriodTest extends TestCase
{
    function testSuccess()
    {
        $timestamp = time();
        $period = new ActivityPeriod($timestamp);
        $this->assertTrue($timestamp === $period->timeStamp());
        $this->assertTrue(date(DATE_ISO8601,$timestamp) === $period->getIso8601());
    }

    /**
     * @expectedException Exception
     */
    function testUnixTimeFormatFail()
    {
        $timestamp = "2017-10-24";
        new ActivityPeriod($timestamp);
    }

    function testAfterNowFail()
    {
        $timestamp = date(strtotime("-1 day"));
        new ActivityPeriod($timestamp);
        $this->assertFalse(ActivityPeriodSpec::isCheck($timestamp));
    }
}
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
        $timeStamp = 1431670515;
        $period = new ActivityPeriod($timeStamp);
        $this->assertTrue("2015-05-15T15:15:15+09:00" === $period->getIso8601());

        $afterTimeStamp = 1898704983; // 2030/03/03 03:03:03
        $afterPeriod = new ActivityPeriod($afterTimeStamp);
        $this->assertTrue(ActivityPeriodSpec::allValidate($afterPeriod->timeStamp()));
    }

    /**
     * @expectedException Exception
     */
    function testUnixTimeFormatFail()
    {
        $timeStamp = "2017-10-24";
        new ActivityPeriod($timeStamp);
    }

    function testAfterNowFail()
    {
        $timeStamp = 1431580454;
        new ActivityPeriod($timeStamp);
        $this->assertFalse(ActivityPeriodSpec::allValidate($timeStamp));
    }
}
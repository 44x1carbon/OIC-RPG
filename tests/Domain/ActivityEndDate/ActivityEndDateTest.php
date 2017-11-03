<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 16:03
 */

 namespace tests\Domain\ActivityEndDate;

 use App\Domain\Party\Spec\ActivityEndDateSpec;
 use App\Domain\Party\ValueObjects\ActivityEndDate;
 use Tests\TestCase;


class ActivityEndDateTest extends TestCase
{
    function testSuccess()
    {
        $timeStamp = 1431670515;
        $period = new ActivityEndDate($timeStamp);
        $this->assertTrue("2015-05-15T15:15:15+09:00" === $period->getIso8601());

        $afterTimeStamp = 1898704983; // 2030/03/03 03:03:03
        $afterPeriod = new ActivityEndDate($afterTimeStamp);
        $this->assertTrue(ActivityEndDateSpec::allValidate($afterPeriod->timeStamp()));
    }

    /**
     * @expectedException Exception
     */
    function testUnixTimeFormatFail()
    {
        $timeStamp = "2017-10-24";
        new ActivityEndDate($timeStamp);
    }

    function testAfterNowFail()
    {
        $timeStamp = 1431580454;
        new ActivityEndDate($timeStamp);
        $this->assertFalse(ActivityEndDateSpec::allValidate($timeStamp));
    }
}
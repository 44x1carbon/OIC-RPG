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
        $afterPeriod = new ActivityEndDate('2030-03-03');
        $this->assertTrue(ActivityEndDateSpec::allValidate($afterPeriod));
    }

    function testAfterNowFail()
    {
        $beforePeriod = new ActivityEndDate('2015-05-15');
        $this->assertFalse(ActivityEndDateSpec::allValidate($beforePeriod));
    }
}
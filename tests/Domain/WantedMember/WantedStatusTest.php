<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 15:20
 */

namespace Tests\Domain\WantedMember;


use App\Domain\WantedMember\ValueObjects\WantedStatus;
use Tests\TestCase;

class WantedStatusTest extends TestCase
{
    function testSuccess()
    {
        $status1 = 'open';
        $wantedStatus1 = new WantedStatus($status1);
        $status2 = 'close';
        $wantedStatus2 = new WantedStatus($status2);

        $this->assertTrue($wantedStatus1->status() === $status1);
        $this->assertTrue($wantedStatus2->status() === $status2);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $status = 'comming';
        new WantedStatus($status);
    }
}
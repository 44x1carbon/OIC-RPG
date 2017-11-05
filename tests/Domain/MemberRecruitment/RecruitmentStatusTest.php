<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 15:20
 */

namespace Tests\Domain\MemberRecruitment;


use App\Domain\MemberRecruitment\ValueObjects\RecruitmentStatus;
use Tests\TestCase;

class RecruitmentStatusTest extends TestCase
{
    function testSuccess()
    {
        $status1 = 'open';
        $recruitmentStatus1 = new RecruitmentStatus($status1);
        $status2 = 'close';
        $recruitmentStatus2 = new RecruitmentStatus($status2);

        $this->assertTrue($recruitmentStatus1->status() === $status1);
        $this->assertTrue($recruitmentStatus2->status() === $status2);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $status = 'comming';
        new RecruitmentStatus($status);
    }
}
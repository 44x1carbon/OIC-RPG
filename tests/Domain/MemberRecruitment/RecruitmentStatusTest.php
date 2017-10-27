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
        $status = 'open';
        new RecruitmentStatus($status);
        $status = 'close';
        new RecruitmentStatus($status);
        $this->assertTrue(true);
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
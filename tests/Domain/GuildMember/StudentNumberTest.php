<?php

use App\Domain\GuildMember\ValueObjects\StudentNumber;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:53
 */

class StudentNumberTest extends \Tests\TestCase
{
    function testSuccess()
    {
        $code = 'B4079';
        new StudentNumber($code);
        $this->assertTrue(true);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $code = 'A111079';
        new StudentNumber($code);
    }
}
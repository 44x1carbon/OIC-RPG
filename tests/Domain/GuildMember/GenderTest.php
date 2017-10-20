<?php

use App\Domain\GuildMember\ValueObjects\Gender;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 11:21
 */


class GenderTest extends TestCase
{
    function testSuccess()
    {
        $type = 'male';
        new Gender($type);
        $type = 'female';
        new Gender($type);
        $this->assertTrue(true);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $type = 'aaaa';
        new Gender($type);
    }
}

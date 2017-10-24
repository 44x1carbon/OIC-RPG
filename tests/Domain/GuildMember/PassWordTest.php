<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 16:35
 */

use App\Domain\GuildMember\ValueObjects\PassWord;

class PassWordTest extends \Tests\TestCase
{
    function testSuccess()
    {
        $password = 'Abcdefg1';
        new PassWord($password);
        $this->assertTrue(true);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $password = 'あいうabc123@';
        new PassWord($password);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:37
 */

use Tests\TestCase;
use App\Domain\GuildMember\ValueObjects\MailAddress;

class MailAddressTest extends TestCase
{
    function testSuccess()
    {
        $address = 'b4000@oic.jp';
        new MailAddress($address);
        $this->assertTrue(true);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $address = '"@oic.jp"hoge.oic.jp@hoge.jp';
        new MailAddress($address);
    }
}

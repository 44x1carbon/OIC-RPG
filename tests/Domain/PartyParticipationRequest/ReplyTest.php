<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/22
 * Time: 14:16
 */

namespace Tests\Domain\PartyParticipationRequest;


use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    function testSuccess()
    {
        $status = 'permit';
        new Reply($status);
        $status = 'rejection';
        new Reply($status);
        $this->assertTrue(true);
    }

    /**
     * @expectedException Exception
     */
    function testFail()
    {
        $status = 'aaaa';
        new Reply($status);
    }
}
<?php

use App\Domain\GetCondition\Spec\GetConditionSpec;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/22
 * Time: 19:06
 */


class GetConditionSpecTest extends TestCase
{
    public function testSuccess()
    {
        $this->assertTrue(GetConditionSpec::validateValue(0));
    }

    public function testFail()
    {
        $this->assertFalse(GetConditionSpec::validateValue(-1));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/02
 * Time: 15:49
 */

namespace App\Domain\Event\ValueObjects;


class EventId
{
    private $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function code()
    {
        return $this->code;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:49
 */

namespace App\Domain\WantedMember\ValueObjects;


use App\Domain\WantedMember\Spec\WantedStatusSpec;
use App\Exceptions\DomainException;

class WantedStatus
{
    const OPEN = 'open';
    const CLOSE = 'close';
    const STATUS_LIST = [self::OPEN, self::CLOSE];

    private $status;

    public function __construct(String $status)
    {
        $this->status = $status;
        if( !WantedStatusSpec::isAvailable($this->status) ) throw new DomainException("Error");
    }

    public function status()
    {
        return $this->status;
    }

    public function equals(WantedStatus $status): bool
    {
        return $status->status() === $this->status;
    }
}
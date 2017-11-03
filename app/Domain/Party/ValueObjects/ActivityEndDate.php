<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 15:59
 */

namespace App\Domain\Party\ValueObjects;

use App\Domain\Party\Spec\ActivityEndDateSpec;
use App\Exceptions\DomainException;

class ActivityEndDate
{

    private $timeStamp;

    public function __construct(int $timeStamp)
    {
        $this->timeStamp = $timeStamp;
        if( !ActivityEndDateSpec::isUnixTimeFormat($this->timeStamp) ) throw new DomainException("Error");
    }

    public function timeStamp()
    {
        return $this->timeStamp;
    }

    public  function getIso8601()
    {
        return date('c', $this->timeStamp);
    }

}
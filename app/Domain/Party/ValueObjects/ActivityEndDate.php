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

    private $date;

    public function __construct(string $dateStr)
    {
        $this->date = new \DateTime($dateStr);
    }

    public function date(): \DateTime
    {
        return $this->date;
    }
}
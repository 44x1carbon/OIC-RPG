<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/22
 * Time: 18:37
 */

namespace App\Domain\GetCondition;


use App\Domain\Skill\Skill;

class GetCondition
{
    private $necessaryLevel;

    public function __construct()
    {
    }

    public function setNecessaryLevel(int $necessaryLevel)
    {
        $this->necessaryLevel = $necessaryLevel;
    }

    public function necessaryLevel(): int
    {
        return $this->necessaryLevel;
    }
}
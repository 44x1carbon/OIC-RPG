<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 19:21
 */

namespace App\Domain\ProductionType;

// ProductionIdeaのValueObjects
class ProductionType
{
    private $name;

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function  name(): String
    {
        return $this->name;
    }
}
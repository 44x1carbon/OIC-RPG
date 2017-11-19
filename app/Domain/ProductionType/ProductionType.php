<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 19:21
 */

namespace App\Domain\ProductionType;

class ProductionType
{
    private $id;
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function  name(): string
    {
        return $this->name;
    }

    public function id(): string
    {
        return $this->id;
    }
}
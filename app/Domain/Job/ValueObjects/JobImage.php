<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/28
 * Time: 11:51
 */

namespace App\Domain\Job\ValueObjects;


class JobImage
{
    private $imageName;
    private $imagePath;

    public function __construct(string $imageName, string $imagePath)
    {
        $this->imageName = $imageName;
        $this->imagePath = $this->imagePath;
    }

    public function imageName(): string
    {
        return $this->imageName;
    }

    public function imagePath(): string
    {
        return $this->imagePath;
    }
}
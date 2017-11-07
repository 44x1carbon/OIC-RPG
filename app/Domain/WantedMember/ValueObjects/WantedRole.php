<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/07
 * Time: 12:20
 */

namespace App\Domain\WantedMember\ValueObjects;

// 募集役割
class WantedRole
{
    // 募集役割名
    private $name;
    // 参考ジョブID
    private $referenceJobId;

    public function __construct(String $name, String $referenceJobId)
    {
        $this->name = $name;
        $this->referenceJobId = $referenceJobId;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function referenceJobId(): String
    {
        return $this->referenceJobId;
    }
}
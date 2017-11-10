<?php

namespace App\Domain\PartyWrittenRequest\ValueObject;

class WantedRoleInfo
{
    // 募集役割名
    private $name;
    // 備考
    private $remarks;
    // 参考ジョブID
    private $referenceJobId;

    function __construct(string $name, string $remarks, string $referenceJobId)
    {
        $this->name = $name;
        $this->remarks = $remarks;
        $this->referenceJobId = $referenceJobId;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function remarks(): string
    {
        return $this->remarks;
    }

    /**
     * @return string
     */
    public function referenceJobId(): string
    {
        return $this->referenceJobId;
    }
}
<?php

namespace App\Presentation\DTO;

class WantedRoleDto
{
    // 募集役割名
    private $roleName;
    // 備考
    private $remarks;
    // 参考ジョブID
    private $referenceJobId;
    // 枠数
    private $frameAmount;

    function __construct(string $roleName, string $remarks, string $referenceJobId, int $frameAmount)
    {
        $this->roleName = $roleName;
        $this->remarks = $remarks;
        $this->referenceJobId = $referenceJobId;
        $this->frameAmount = $frameAmount;
    }

    /**
     * @return string
     */
    public function roleName(): string
    {
        return $this->roleName;
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

    /**
     * @return int
     */
    public function frameAmount(): int
    {
        return $this->frameAmount;
    }
}
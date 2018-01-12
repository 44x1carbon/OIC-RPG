<?php

namespace App\Infrastracture\WantedMember;


use App\Domain\WantedMember\ValueObjects\WantedStatus;

class WantedStatusViewModel
{
    private $wantedStatus;

    /**
     * WantedStatusViewModel constructor.
     * @param \App\Domain\WantedMember\ValueObjects\WantedStatus $wantedStatus
     */
    public function __construct(WantedStatus $wantedStatus)
    {
        $this->wantedStatus = $wantedStatus;
        $this->status = $wantedStatus->status();
    }

    /**
     * @return string
     */
    public function toJa(): string
    {
        switch ($this->status) {
            case WantedStatus::CLOSE : return '停止中'; break;
            case WantedStatus::OPEN  : return '募集中'; break;
        }
    }
}

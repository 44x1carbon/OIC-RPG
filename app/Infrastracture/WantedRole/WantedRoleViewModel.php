<?php

namespace App\Infrastracture\WantedRole;

use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\WantedRole;
use App\Infrastracture\Job\JobViewModel;
use App\Infrastracture\WantedMember\WantedMemberViewModel;

class WantedRoleViewModel
{
    private $referenceJob = null;
    private $wantedRole;
    private $wantedMembers = null;

    /**
     * WantedRoleViewModel constructor.
     * @param WantedRole $wantedRole
     */
    public function __construct(WantedRole $wantedRole)
    {
        $this->wantedRole = $wantedRole;
        $this->id = $wantedRole->id();
        $this->roleName = $wantedRole->roleName();
        $this->remarks = $wantedRole->remarks();
        $this->totalFrameNum = $wantedRole->totalFrameNum();
        $this->assignedFrameNum = $wantedRole->assignedFrameNum();
        $this->assignableFrameNum = $wantedRole->assignableFrameNum();
    }

    /**
     * @return JobViewModel
     */
    public function referenceJob(): JobViewModel
    {
        $this->referenceJob = $this->referenceJob ?? new JobViewModel($this->wantedRole->referenceJob());
        return $this->referenceJob;
    }

    /**
     * @return array
     */
    public function wantedMembers(): array
    {
        $this->wantedMembers = $this->wantedMembers ?? array_map(function(WantedMember $wantedMember) {
            return new WantedMemberViewModel($wantedMember);
        }, $this->wantedRole->wantedMemberList()->all());

        return $this->wantedMembers;
    }

    /**
     * @return bool
     */
    public function isFrameFull(): bool
    {
        return $this->wantedRole->isFrameFull();
    }

    /**
     * @return bool
     */
    public function isFrameEmpty(): bool
    {
        return $this->wantedRole->isFrameEmpty();
    }
}

<?php

namespace App\Infrastracture\WantedMember;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\WantedMember\WantedMember;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class WantedMemberViewModel
{
    private $wantedMember;
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    private $guildMemberRepo;
    private $officer = null;

    /**
     * WantedMemberViewModel constructor.
     * @param WantedMember $wantedMember
     */
    public function __construct(WantedMember $wantedMember)
    {
        $this->wantedMember = $wantedMember;
        $this->id = $wantedMember->id();
        $this->status = new WantedStatusViewModel($wantedMember->wantedStatus());
        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
    }

    /**
     * @return GuildMemberViewModel|null
     */
    public function officer(): ?GuildMemberViewModel
    {
        if(!is_null($this->officer)) {
            if(is_null($this->wantedMember->officerId())) return null;
            $officer = $this->guildMemberRepo->findByStudentNumber($this->wantedMember->officerId());
            $this->officer = new GuildMemberViewModel($officer);
        }

        return $this->officer;
    }
}

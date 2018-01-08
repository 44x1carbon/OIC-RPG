<?php

namespace App\Infrastracture\Party;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\PartyMemberInfo;
use App\Infrastracture\GuildMember\GuildMemberViewModel;
use App\Infrastracture\WantedRole\WantedRoleViewModel;

class PartyMemberInfoViewModel
{
    private $partyMemberInfo;
    /* @var PartyRepositoryInterface $partyRepo */
    private $partyRepo;
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    private $guildMemberRepo;
    private $party = null;
    private $member = null;

    /**
     * PartyMemberInfoViewModel constructor.
     * @param PartyMemberInfo $partyMemberInfo
     */
    public function __construct(PartyMemberInfo $partyMemberInfo)
    {
        $this->partyMemberInfo = $partyMemberInfo;
        $this->assigneeRole = new WantedRoleViewModel($partyMemberInfo->assigneeRole());

        $this->partyRepo = app(PartyRepositoryInterface::class);
        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
    }

    /**
     * @return PartyViewModel
     */
    public function party(): PartyViewModel
    {
        if(is_null($this->party)) {
            $party = $this->partyRepo->findById($this->partyMemberInfo->partyId());
            $this->party = new PartyViewModel($party);
        }

        return $this->party;
    }

    /**
     * @return GuildMemberViewModel
     */
    public function member(): GuildMemberViewModel
    {
        if(is_null($this->member)) {
            $member = $this->guildMemberRepo->findByStudentNumber($this->partyMemberInfo->memberId());
            return $this->member = new GuildMemberViewModel($member);
        }

        return $this->member;
    }
}

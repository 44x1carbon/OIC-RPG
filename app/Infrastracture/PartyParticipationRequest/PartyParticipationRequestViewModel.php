<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/14
 * Time: 14:40
 */

namespace App\Infrastracture\PartyParticipationRequest;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Infrastracture\GuildMember\GuildMemberViewModel;
use App\Infrastracture\Party\PartyViewModel;
use App\Infrastracture\WantedRole\WantedRoleViewModel;

class PartyParticipationRequestViewModel
{
    private $partyParticipationRequest;
    /* @var PartyRepositoryInterface $partyRepo */
    private $partyRepo;
    /* @var GuildMemberRepositoryInterface $guildMemberRepo */
    private $guildMemberRepo;
    private $party = null;
    private $wantedRole = null;
    private $applicant = null;

    public function __construct(PartyParticipationRequest $partyParticipationRequest)
    {
        $this->partyParticipationRequest = $partyParticipationRequest;
        $this->id = $partyParticipationRequest->id();
        $this->reply = $partyParticipationRequest->reply();
        $this->partyRepo = app(PartyRepositoryInterface::class);
        $this->guildMemberRepo = app(GuildMemberRepositoryInterface::class);
    }

    public function party(): PartyViewModel
    {
        if (is_null($this->party)){
            $party = $this->partyRepo->findById($this->partyParticipationRequest->partyId());
            $this->party = new PartyViewModel($party);
        }

        return $this->party;
    }

    public function wantedRole(): WantedRoleViewModel
    {
        if (is_null($this->wantedRole)){
            $party = $this->party();
            $result = array_values(array_filter($party->wantedRoles(), function (WantedRoleViewModel $wantedRole) {
                if ($wantedRole->id === $this->partyParticipationRequest->wantedRoleId()){
                    return $wantedRole;
                };
            }));
            if(count($result) > 0) {
                $this->wantedRole = $result[0];
            }
        }

        return $this->wantedRole;
    }

    public function applicant(): GuildMemberViewModel
    {
        if (is_null($this->applicant)){
            $guildMember = $this->guildMemberRepo->findByStudentNumber($this->partyParticipationRequest->guildMemberId());
            $this->applicant = new GuildMemberViewModel($guildMember);
        }

        return $this->applicant;
    }

}
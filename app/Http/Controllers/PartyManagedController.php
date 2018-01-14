<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/14
 * Time: 18:10
 */

namespace App\Http\Controllers;


use App\Domain\GuildMember\GuildMember;
use App\Domain\Party\Party;
use App\Domain\WantedRole\WantedRole;
use App\Infrastracture\Party\PartyViewModel;
use App\Infrastracture\PartyParticipationRequest\PartyParticipationRequestViewModel;
use App\Infrastracture\WantedRole\WantedRoleViewModel;
use App\Presentation\PartyParticipationRequestFacade;
use App\Presentation\PartyServiceFacade;

class PartyManagedController
{

    // 自分の管理しているパーティ一覧
    public function holding(GuildMember $loginMember, PartyServiceFacade $partyServiceFacade)
    {
        $resultHoldingParties = $partyServiceFacade->managedParties($loginMember->studentNumber()->code());

        $holdingParties = array_map(function(Party $party) { return new PartyViewModel($party);}, $resultHoldingParties);

        return view('Guild.Party.Management.Holding')
            ->with('holdingParties', $holdingParties);
    }

    // 自分が参加しているパーティ一覧
    public function entry(GuildMember $loginMember, PartyServiceFacade $partyServiceFacade)
    {
        $resultEntryParties = $partyServiceFacade->officerParties($loginMember->studentNumber()->code());

        $entryParties = array_map(function(Party $party) { return new PartyViewModel($party);}, $resultEntryParties);

        // 参加しているパーティIDをKeyとしたWantedRoleのリストを用意
        /* @var Party $entryParty */
        foreach ($resultEntryParties as $entryParty) {
            $entryWantedRoleList[$entryParty->id()] = new WantedRoleViewModel($entryParty->findWantedRoleListByPartyMemberId($loginMember->studentNumber()));
        }

        return view('Guild.Party.Management.Entry')
            ->with('entryParties', $entryParties)
            ->with('entryWantedRoleList', $entryWantedRoleList);
    }

    // 自分が参加申請を出しているパーティ一覧
    public function applying(GuildMember $loginMember, PartyServiceFacade $partyServiceFacade, PartyParticipationRequestFacade $partyParticipationRequestFacade)
    {
        $resultApplyingParties = $partyServiceFacade->partyParticipationRequestSendParties($loginMember->studentNumber()->code());

        $applyingParties = array_map(function(Party $party) { return new PartyViewModel($party);}, $resultApplyingParties);

        // 参加申請を出しているパーティIDをKeyとした、パーティ参加申請のViewModelのリストを用意
        $partyParticipationRequestList = $partyParticipationRequestFacade->findStudentNumberPartyParticipationRequestList($loginMember->studentNumber()->code());
        $applyingPartyParticipationRequestList = null;
        foreach ($partyParticipationRequestList as $partyParticipationRequest) {
            $applyingPartyParticipationRequestList[$partyParticipationRequest->partyId()] = new PartyParticipationRequestViewModel($partyParticipationRequest);
        }

        return view('Guild.Party.Management.Applying')
            ->with('applyingParties', $applyingParties)
            ->with('applyingPartyParticipationRequestList', $applyingPartyParticipationRequestList);
    }

}
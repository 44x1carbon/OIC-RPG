<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Http\Requests\PartyCreateRequest;
use App\Infrastracture\Party\PartyViewModel;
use App\Presentation\PartyServiceFacade;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function store(
        PartyCreateRequest $request,
        PartyServiceFacade $partyServiceFacade,
        GuildMember $loginMember
    )
    {
        $partyId = $partyServiceFacade->registerParty(
            $loginMember->studentNumber()->code(),
            $request->partyDto()
        );
        session()->forget('party');

        return redirect()->route('show_party_detail', ['partyId' => $partyId]);
    }

    public function search(Request $request, PartyServiceFacade $partyServiceFacade)
    {
        $keyword = $request->input('keyword', '');
        $searchResult = $partyServiceFacade->searchParty($keyword);
        return view('Guild.Search.Party')
            ->with('searchResult', $searchResult);
    }
  
    public function detail(GuildMember $loginMember, string $partyId, PartyRepositoryInterface $partyRepository)
    {
        /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepo */
        $partyParticipationRequestRepo = app(PartyParticipationRequestRepositoryInterface::class);
        $party = $partyRepository->findById($partyId);

        // パーティに対し申請中の役割があれば取得
        $partyParticipationRequestWantedRoleId = null;
        $myPartyParticipationRequest = $partyParticipationRequestRepo->findByPartyIdAndStudentNumber($partyId, $loginMember->studentNumber());
        if($myPartyParticipationRequest){
            $partyParticipationRequestWantedRoleId = $myPartyParticipationRequest->wantedRoleId();
        }

        // パーティに既に参加している場合は取得
        $myPartyMemberInfo = null;
        foreach ($party->partyMembers() as $partyMemberInfo) {
            if($loginMember->studentNumber()->equals($partyMemberInfo->memberId())){
                $myPartyMemberInfo = $partyMemberInfo;
            }
        };

        return view('Guild.Party.Detail')
            ->with('party', new PartyViewModel($party))
            ->with('partyParticipationRequestWantedRoleId', $partyParticipationRequestWantedRoleId)
            ->with('myPartyMemberInfo', $myPartyMemberInfo);
    }
}

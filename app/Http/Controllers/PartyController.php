<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Http\Requests\PartyCreateRequest;
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

        return response($partyId);
    }

    public function search(Request $request, PartyServiceFacade $partyServiceFacade)
    {
        $keyword = $request->input('keyword', '');
        $searchResult = $partyServiceFacade->searchParty($keyword);
        return view('Guild.Search.Party')
            ->with('searchResult', $searchResult);
    }
}

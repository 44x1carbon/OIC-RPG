<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Http\Requests\PartyCreateRequest;
use App\Infrastracture\Party\PartyViewModel;
use App\Presentation\PartyServiceFacade;

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

    public function detail(string $partyId, PartyRepositoryInterface $partyRepository)
    {
        $party = $partyRepository->findById($partyId);

        return view('Guild.Party.Detail')
            ->with('party', new PartyViewModel($party));
    }
}

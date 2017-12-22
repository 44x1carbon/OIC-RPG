<?php

namespace App\Http\Controllers;

class PartyRegistrationController extends Controller
{
    public function showProductionIdea()
    {
        return view('Guild.Party.Registration.ProductionIdea');
    }

    public function doProductionIdea(ProductionIdeaRequest $request)
    {

    }

    public function showWanted()
    {
        return view('Guild.Party.Registration.Wanted');
    }

    public function handleWanted(HandleWantedRequest $request)
    {

    }

    public function doWanted(WantedRequest $request)
    {

    }

    public function addWantedRole(AddWantedRoleRequest $request)
    {

    }

    public function showConfirm()
    {
        return view('Guild.Party.Registration.Confirm');
    }
}
<?php

namespace App\Http\Controllers;

class PartyRegistrationController extends Controller
{
    public function showProductionIdea()
    {
        return view('Guild.Party.Registration.ProductionIdea');
    }

    public function showWanted()
    {
        return view('Guild.Party.Registration.Wanted');
    }

    public function showConfirm()
    {
        return view('Guild.Party.Registration.Confirm');
    }
}
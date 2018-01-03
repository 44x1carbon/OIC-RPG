<?php

namespace App\Http\Controllers;

use App\Domain\Job\JobRepositoryInterface;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Http\Requests\PartyRegistration\AddWantedRoleRequest;
use App\Http\Requests\PartyRegistration\HandleWantedRequest;
use App\Http\Requests\PartyRegistration\ProductionIdeaRequest;
use App\Http\Requests\PartyRegistration\WantedRequest;
use App\Presentation\DTO\PartyDto;
use App\Presentation\DTO\WantedRoleDto;

class PartyRegistrationController extends Controller
{

    public function getSessionData(): PartyDto
    {
        return session('party', new PartyDto());
    }

    public function setSessionData(PartyDto $partyDto)
    {
        session(['party' => $partyDto]);
    }


    public function showProductionIdea(ProductionTypeRepositoryInterface $productionTypeRepository)
    {
        return view('Guild.Party.Registration.ProductionIdea')
            ->with('productionTypes', $productionTypeRepository->all());
    }

    public function doProductionIdea(ProductionIdeaRequest $request)
    {
        $this->controlSessionDate(function(PartyDto $sessionData) use($request) {
            $sessionData->setActivityEndDate($request->activityEndDate());
            $sessionData->setProductionIdeaDto($request->productionIdeaDto());
            return $sessionData;
        });

        return redirect()->route('show_party_registration_wanted');
    }

    public function showProductionIdea(ProductionTypeRepositoryInterface $productionTypeRepository)
    {
        return view('Guild.Party.Registration.ProductionIdea')
            ->with('productionTypes', $productionTypeRepository->all());
    }

    public function doProductionIdea(ProductionIdeaRequest $request)
    {
        $this->controlSessionDate(function(PartyDto $sessionData) use($request) {
            $sessionData->setActivityEndDate($request->activityEndDate());
            $sessionData->setProductionIdeaDto($request->productionIdeaDto());
            return $sessionData;
        });

        return redirect()->route('show_party_registration_wanted');
    }

    public function showWanted(JobRepositoryInterface $jobRepository)
    {
        return view('Guild.Party.Registration.Wanted')
            ->with('session', $this->getSessionData())
            ->with('allJob', $jobRepository->all());
    }

    public function handleWanted(HandleWantedRequest $request)
    {
        $wantedRequest = WantedRequest::create($request->url(), $request->method(), $request->all() );
        if($request->isAdd()) return $this->addWantedRole($wantedRequest);
        if($request->isDone()) return $this->doWanted($wantedRequest);
    }

    public function doWanted(WantedRequest $request)
    {
        $this->controlSessionDate(function(PartyDto $sessionData) use($request) {
            $sessionData->setWantedRoleDtos($request->wantedRoleDtos());
            return $sessionData;
        });
        return redirect()->route('show_party_confirm');
    }

    public function addWantedRole(WantedRequest $request)
    {

        return view('Guild.Party.Registration.Wanted')
            ->with('session', $this->getSessionData());
    }

    public function handleWanted(HandleWantedRequest $request)
    {
        $wantedRequest = WantedRequest::create($request->url(), $request->method(), $request->all() );
        if($request->isAdd()) return $this->addWantedRole($wantedRequest);
        if($request->isDone()) return $this->doWanted($wantedRequest);
    }

    public function doWanted(WantedRequest $request)
    {
        $this->controlSessionDate(function(PartyDto $sessionData) use($request) {
            $sessionData->setWantedRoleDtos($request->wantedRoleDtos());
            return $sessionData;
        });
        return redirect()->route('show_party_confirm');
    }

    public function addWantedRole(WantedRequest $request)
    {
        $this->controlSessionDate(function(PartyDto $sessionData) use($request) {
            $sessionData->setWantedRoleDtos($request->wantedRoleDtos());
            $sessionData->wantedRoleDtos[] = new WantedRoleDto();
            return $sessionData;
        });

        return redirect()->route('show_party_registration_wanted');
    }

    public function showConfirm()
    {
        return view('Guild.Party.Registration.Confirm')
            ->with('session', $this->getSessionData());
    }

    protected function createConfirmData()
    {
        $productionTypeRepo = app(ProductionTypeRepositoryInterface::class);
        $session = session('party');
        $session['productionIdea']['productionType'] = $productionTypeRepo->findById($session['productionIdea']['productionTypeId']);
        return $session;
    }

    protected function controlSessionDate(callable $func) {
        $sessionData = $this->getSessionData();
        $this->setSessionData($func($sessionData));
    }
}
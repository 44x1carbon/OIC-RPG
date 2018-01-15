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
        if(env('APP_ENV') == 'local') {
            $productionTypeRepo = app(\App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface::class);
            $jobRepo            = app(\App\Domain\Job\JobRepositoryInterface::class);

            $activeEndDate = \Carbon\Carbon::tomorrow()->format('Y-m-d');
            $productionTypeDto = new \App\Presentation\DTO\ProductionTypeDto(
                $productionTypeRepo->findByName('Webシステム')->id(),
                'Webシステム'
            );
            $productionIdeaDto = new \App\Presentation\DTO\ProductionIdeaDto(
                '学内での共同制作を推進するサービス(デモ)',
                $productionTypeDto,
                '学内には様々なコースの優秀な学生がたくさんいます。現状、コース間での交流はほぼなく共同で作品を作る機会もありません。お互いが得意な分野で力を合わせることでより良い作品が作れると私は信じております。そこで学内での共同制作を推進するサービスを作成しようと考えています。スキルの可視化や制作メンバーの募集が主な機能になります。'
            );
            $partyDto = new \App\Presentation\DTO\PartyDto(
                $activeEndDate,
                $productionIdeaDto,
                [
                    new WantedRoleDto(
                        'サーバーサイドエンジニア',
                        '言語はPHP、フレームワークはLaravelの5.4を利用します',
                        $jobRepo->findByName('Webエンジニア')->jobId()->code(),
                        3,
                        true
                    ),
                    new WantedRoleDto(
                        'Webデザイナー',
                        'スマホ用のWebアプリをデザインしていただきます。マークアップもできる方が良いです。',
                        $jobRepo->findByName('Webデザイナー')->jobId()->code(),
                        1,
                        false
                    ),
                    new WantedRoleDto(
                        'キャラクター絵師',
                        'RPG風のアプリにする予定です。ジョブにキャラクターの立ち絵を使いたいのでファンタジーなキャラが書ける人を募集しています。',
                        $jobRepo->findByName('ゲームグラフィッカー')->jobId()->code(),
                        4,
                        false
                    ),
                ]
            );
            $this->setSessionData($partyDto);
        }

        return view('Guild.Party.Registration.ProductionIdea')
            ->with('session', $this->getSessionData())
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
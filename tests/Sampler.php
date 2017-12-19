<?php

namespace Tests;

use App\ApplicationService\GuildMemberAppService;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\ProductionType\ProductionType;
use App\Eloquents\ProductionTypeEloquent;
use App\Presentation\GuildMemberFacade;
use App\Presentation\PartyServiceFacade;
use Faker\Factory as Faker;

trait Sampler
{
    public function sampleProductionType(): ProductionType
    {
        /* @var ProductionTypeEloquent $model */
        $model = ProductionTypeEloquent::all()->random();
        if(is_null($model)) throw new Exception('ProductionTypeのデータがありません。');
        return $model->toEntity();
    }

    public function sampleGuildMember(): GuildMember
    {
        /* @var GuildMemberFacade $guildMemberFacade*/
        $guildMemberFacade = app(GuildMemberFacade::class);

        $faker = Faker::create('ja_JP');

        $genderList = Gender::TYPE_LIST;
        $studentNumberData = "B".$faker->numberBetween(4000,4999);

        $data = array(
            "studentNumberData" => $studentNumberData,
            "studentName" => $faker->name,
            "courseId" => $faker->randomNumber(1)%3+1,
            "genderId" => $genderList[$faker->randomNumber(1)%2],
            "mailAddressData" => $studentNumberData."@oic.jp",
            "password" => $faker->bothify('????####'),
        );

        $authData = $guildMemberFacade::registerMember($data['studentNumberData'], $data['studentName'], $data['courseId'], $data['genderId'], $data['mailAddressData'], $data['password']);

        return $authData->guildMemberEntity();
    }

    /**
     * サンプルのパーティを作成する。
     * 引数にpartyManagerIdを渡すとそのユーザーが作成した状態にできる
     *
     * @param string|null partyManagerId
     * @return Party
     */
    public function sampleParty(string $partyManagerId = null): Party
    {
        $partyServiceFacade = app(PartyServiceFacade::class);
        $partyRepository = app(PartyRepositoryInterface::class);

        $faker = Faker::create('ja_JP');

        $data = array(
            "roleName" => $faker->realText($faker->numberBetween(10,10)),
            "partyManagerId" => $partyManagerId ?? "B".$faker->numberBetween(4000,4999),
            "activityEndDate" => $faker->dateTimeThisMonth->format('Y-m-d'),
            "ideaName" => $faker->realText($faker->numberBetween(10,20)),
            "ideaDescription" => $faker->realText($faker->numberBetween(20,40)),
        );
        $productionType = $this->sampleProductionType();

        $partyId = $partyServiceFacade->registerParty($data["activityEndDate"], $data["partyManagerId"], $data["roleName"], $data["ideaName"], $productionType->id()->code(), $data["ideaDescription"]);

        return $partyRepository->findById($partyId);
    }
}
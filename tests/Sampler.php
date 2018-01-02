<?php

namespace Tests;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
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

    public function sampleGuildMember($attr = []): GuildMember
    {
        /* @var GuildMemberFacade $guildMemberFacade*/
        $guildMemberFacade = app(GuildMemberFacade::class);

        $faker = Faker::create('ja_JP');

        $genderList = Gender::TYPE_LIST;
        $studentNumberData = "B".$faker->numberBetween(4000,4999);

        $data = array_merge(
            [
                "studentNumber" => $studentNumberData,
                "studentName" => $faker->name,
                "courseId" => $faker->randomNumber(1)%2+1,
                "genderId" => $genderList[$faker->randomNumber(1)%2],
                "mailAddress" => $studentNumberData."@oic.jp",
                "password" => $faker->bothify('????####'),
            ],
            $attr
        );
        $possessionSkill = $this->samplePossessionSkill();

        // TODO FacadeにPossessionSkillsの中身が連想配列ではなくDTOになった場合は変更する
        $authData = $guildMemberFacade::registerMember($data['studentNumber'], $data['studentName'], $data['courseId'], $data['genderId'], $data['mailAddress'], $data['password'], [['skillId' => $possessionSkill->skillId(), 'studentNumber' => $possessionSkill->studentNumber()->code()]]);

        return $authData->guildMemberEntity();
    }

    public function samplePossessionSkill($attr = []): PossessionSkill
    {
        /* @var PossessionSkillFactory $possessionSkillFactory */
        $possessionSkillFactory = app(PossessionSkillFactory::class);

        $faker = Faker::create('ja_JP');

        $studentNumberData = "B".$faker->numberBetween(4000,4999);

        $data = array_merge(
            [
                "skillId" => $faker->randomNumber(1)%10+1,
                "studentNumber" => $studentNumberData
            ],
            $attr
        );

        return $possessionSkillFactory->createPossessionSkill($data['skillId'], new StudentNumber($data['studentNumber']));
    }

    /**
     * サンプルのパーティを作成する。
     * 引数にpartyManagerIdを渡すとそのユーザーが作成した状態にできる
     *
     * @param string|null partyManagerId
     * @return Party
     */
    public function sampleParty($attr = []): Party
    {
        $partyServiceFacade = app(PartyServiceFacade::class);
        $partyRepository = app(PartyRepositoryInterface::class);

        $faker = Faker::create('ja_JP');

        $data = array_merge(
            [
                "roleName" => $faker->realText($faker->numberBetween(10,10)),
                "partyManagerId" => "B".$faker->numberBetween(4000,4999),
                "activityEndDate" => $faker->dateTimeThisMonth->format('Y-m-d'),
                "ideaName" => $faker->realText($faker->numberBetween(10,20)),
                "ideaDescription" => $faker->realText($faker->numberBetween(20,40)),
            ],
            $attr
        );
        $productionType = $this->sampleProductionType();

        $partyId = $partyServiceFacade->registerParty($data["activityEndDate"], $data["partyManagerId"], $data["roleName"], $data["ideaName"], $productionType->id()->code(), $data["ideaDescription"]);

        return $partyRepository->findById($partyId);
    }
}
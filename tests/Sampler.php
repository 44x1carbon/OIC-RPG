<?php

namespace Tests;

use App\ApplicationService\GuildMemberAppService;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\ProductionType\ProductionType;
use App\Eloquents\ProductionTypeEloquent;
use App\Infrastracture\AuthData\AuthData;
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
        /* @var GuildMemberRepositoryInterface $guildMemberRepo*/
        $guildMemberRepo = app(GuildMemberRepositoryInterface::class);
        /* @var GuildMemberFactory $guildMemberFactory */
        $guildMemberFactory = app(GuildMemberFactory::class);
        /* @var CourseRepositoryInterface $courseRepo */
        $courseRepo = app(CourseRepositoryInterface::class);

        $faker = Faker::create('ja_JP');

        $genderList = Gender::TYPE_LIST;
        $studentNumberData = "B".$faker->numberBetween(4000,4999);

        $data = array_merge(
            [
                SampleGuildMember::studentNumber            => new StudentNumber($studentNumberData),
                SampleGuildMember::studentName              => $faker->name,
                SampleGuildMember::course                   => array_random($courseRepo->all()),
                SampleGuildMember::gender                   => new Gender($genderList[$faker->randomNumber(1)%2]),
                SampleGuildMember::mailAddress              => new MailAddress($studentNumberData."@oic.jp"),
                SampleGuildMember::password                 => $faker->bothify('????####'),
                SampleGuildMember::favoriteJobId            => null,
                SampleGuildMember::possessionSkills         => null,
                SampleGuildMember::possessionJobCollection  => null,
            ],
            $attr
        );


        $guildMember = $guildMemberFactory->createGuildMember(
            $data[SampleGuildMember::studentNumber],
            $data[SampleGuildMember::studentName],
            $data[SampleGuildMember::course],
            $data[SampleGuildMember::gender],
            $data[SampleGuildMember::mailAddress],
            $data[SampleGuildMember::favoriteJobId],
            $data[SampleGuildMember::possessionSkills],
            $data[SampleGuildMember::possessionJobCollection]
        );

        AuthData::create([
            'email' => $data[SampleGuildMember::mailAddress]->address(),
            'password' => $data[SampleGuildMember::password]
        ]);

        $guildMemberRepo->save($guildMember);

        return $guildMember;
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

class SampleGuildMember
{
    const studentNumber = 'studentNumber';
    const studentName = 'studentName';
    const course = 'course';
    const gender = 'gender';
    const mailAddress = 'mailAddress';
    const password = 'password';
    const favoriteJobId = 'favoriteJobId';
    const possessionSkills = 'possessionSkills';
    const possessionJobCollection = 'possessionJobCollection';
}
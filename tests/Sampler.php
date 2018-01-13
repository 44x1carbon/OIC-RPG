<?php

namespace Tests;

use App\ApplicationService\GuildMemberAppService;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\ProductionType\ProductionType;
use App\Eloquents\ProductionTypeEloquent;
use App\Infrastracture\AuthData\AuthData;
use App\Presentation\DTO\PartyDto;
use App\Presentation\DTO\ProductionIdeaDto;
use App\Presentation\DTO\ProductionTypeDto;
use App\Presentation\DTO\WantedRoleDto;
use App\Presentation\PartyServiceFacade;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

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
                SampleGuildMember::password                 => new PassWord($faker->bothify('????####')),
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

        AuthData::registerMember(new LoginInfo(
            $data[SampleGuildMember::mailAddress],
            $data[SampleGuildMember::password]
        ));

        $guildMemberRepo->save($guildMember);

        return $guildMember;
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
                "productionTheme" => $faker->realText($faker->numberBetween(10,20)),
                "ideaDescription" => $faker->realText($faker->numberBetween(20,40)),
            ],
            $attr
        );
        $productionType = $this->sampleProductionType();

        //     function __construct(string $roleName = null, string $remarks = null, string $referenceJobId = null, int $frameAmount = null, bool $managerAssigned = false)

        $productionIdeaDto = new ProductionIdeaDto($data["productionTheme"], new ProductionTypeDto($productionType->id(), $productionType->name()), $data["ideaDescription"]);
        $wantedRoleDtos = [new WantedRoleDto($data["roleName"], null, null, 1, true)];
        $partyDto = new PartyDto($data["activityEndDate"], $productionIdeaDto, $wantedRoleDtos);
        $partyId = $partyServiceFacade->registerParty($data["partyManagerId"], $partyDto);

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
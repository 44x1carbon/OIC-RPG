<?php

use App\ApplicationService\GuildMemberAppService;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\PassWord;

class PartyStoreTest extends \Tests\TestCase
{
    /* @var GuildMemberAppService $guildMemberAppService*/
    protected $guildMemberAppService;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->guildMemberAppService = app(GuildMemberAppService::class);
        /* @var CourseRepositoryInterface $courseRepository */
        $courseRepository = app(CourseRepositoryInterface::class);
        $authData = $this->guildMemberAppService->registerMember(
            new StudentNumber('B4079'),
            '山崎 好洋',
            $courseRepository->all()[0],
            new Gender(Gender::MALE),
            new MailAddress('b4079@oic.jp'),
            new LoginInfo(new MailAddress('b4079@oic.jp'), new PassWord('12345678'))
        );
        $this->actingAs($authData);
    }

    public function testSuccess()
    {
        $response = $this->post(route('store_party'),[
            'party' => [
                'activityEndDate' => '2018-02-12',
                'productionIdea' => [
                    'productionTheme' => 'チーム開発を支援するサービス',
                    'productionType' => 'システム',
                    'ideaDescription' => 'チーム内のコミュニティをITの力で円滑に進められるサービスを制作します',
                ],
                'wantedRoleList' => [
                    [
                        'remarks' => '技術が大好きな人を募集中',
                        'name' => 'サーバサイドエンジニア',
                        'referenceJobId' => 1,
                        'frameAmount' => 2,
                    ]
                ]
            ]
        ]);

        $response->assertStatus(200);
}
}
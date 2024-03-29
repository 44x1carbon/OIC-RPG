<?php

use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Infrastracture\AuthData\AuthData;

class PartyStoreTest extends \Tests\TestCase
{
    use \Tests\Sampler;

    protected $productionTypeRepository;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->productionTypeRepository = app(ProductionTypeRepositoryInterface::class);
        $guildMember = $this->sampleGuildMember(['password' => new Password('abcd1234')]);
        $authData = AuthData::findByLoginInfo(new LoginInfo($guildMember->mailAddress(), new PassWord("abcd1234")));
        $this->actingAs($authData);
    }

    public function testSuccess()
    {
        $data = [
            'party' => [
                'activityEndDate' => '2018-02-12',
                'productionIdea' => [
                    'productionTheme' => 'チーム開発を支援するサービス',
                    'productionTypeId' => $this->productionTypeRepository->all()[0]->id(),
                    'ideaDescription' => 'チーム内のコミュニティをITの力で円滑に進められるサービスを制作します',
                ],
                'wantedRoleList' => [
                    [
                        'remarks' => '技術が大好きな人を募集中',
                        'roleName' => 'サーバサイドエンジニア',
                        'referenceJobId' => 1,
                        'frameAmount' => 2,
                        'managerAssigned' => true,
                    ]
                ]
            ]
        ];

        $response = $this->post(route('store_party'), $data);

        $response->assertStatus(302);
    }
}
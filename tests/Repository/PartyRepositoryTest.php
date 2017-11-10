<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 18:08
 */

namespace Tests\Repository;


use App\Domain\GuildMember\GuildMember;
use App\Domain\Party\Factory\PartyFactory;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Domain\ProductionType\ProductionType;
use App\Domain\WantedMember\WantedMember;
use Tests\TestCase;

class PartyRepositoryTest extends TestCase
{
    protected $partyRepository;
    protected $partyFactory;
    protected $productionIdeaFactory;
    protected $guildMemberFactory;

    public function setUp()
    {
        parent::setUp();
        $this->partyRepository = app(PartyRepositoryInterface::class);
        $this->partyFactory = new PartyFactory();
        $this->productionIdeaFactory = new ProductionIdeaFactory();
    }

    function testSave()
    {
        $party = $this->createPartyEntity("種類名", "アイデア名", "説明", "abc");
        $this->partyRepository->save($party);
        $findParty = $this->partyRepository->findById("abc");

        $this->assertTrue($findParty->productionIdea() === $party->productionIdea());
    }


    function testFindById()
    {
        $party = $this->createPartyEntity("種類名1", "アイデア名1", "説明1");
        $this->partyRepository->save($party);
        $party2 = $this->createPartyEntity("種類名2", "アイデア名2", "説明2");
        $this->partyRepository->save($party2);
        $findParty = $this->partyRepository->findById($party->id());

        $this->partyRepository->findById("hoge");
        $this->assertTrue(true);
    }

    // テスト用にパーティのEntityを作成してくれるメソッド
    function createPartyEntity(String $typeName, String $ideaName, String $ideaDescription, String $id = null)
    {
        $activityEndDate = new ActivityEndDate(1431670515);
        // TODO : ProductionTypeがオンメモリーの間だけnewして取得
        $productionType = new ProductionType($typeName);
        $productionIdea = $this->productionIdeaFactory->createProductionIdea($ideaName, $productionType, $ideaDescription);
        $partyManager = new GuildMember();
        $partyMembers[] = new GuildMember();
        $wanteds[] = new WantedMember();
        $party = $this->partyFactory->createParty($activityEndDate, $productionIdea, $partyManager, $partyMembers, $wanteds, $id);
        return $party;
    }
}
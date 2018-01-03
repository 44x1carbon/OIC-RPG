<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 18:08
 */

namespace Tests\Repository;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Factory\PartyFactory;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionType\ProductionType;
use App\Domain\WantedRole\WantedRole;
use Tests\Sampler;
use Tests\TestCase;

class PartyRepositoryTest extends TestCase
{
    use Sampler;

    /* @var PartyRepositoryInterface $partyRepository */
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
        $party = $this->createPartyEntity("アイデア名", "説明", "abc");
        $this->partyRepository->save($party);
        $findParty = $this->partyRepository->findById($party->id());

        $this->assertTrue($findParty->productionIdea() == $party->productionIdea());
    }


    function testFindById()
    {
        $party = $this->createPartyEntity("アイデア名1", "説明1");
        $this->partyRepository->save($party);
        $party2 = $this->createPartyEntity("アイデア名2", "説明2");
        $this->partyRepository->save($party2);
        $findParty = $this->partyRepository->findById($party->id());

        $this->partyRepository->findById("hoge");
        $this->assertTrue(true);
    }

    // テスト用にパーティのEntityを作成してくれるメソッド
    function createPartyEntity(String $ideaName, String $ideaDescription, String $id = null)
    {
        $activityEndDate = new ActivityEndDate('2019-11-11');
        $partyManagerId = new StudentNumber("B1234");
        $id = $this->partyRepository->nextId();
        $party = new Party($id, $activityEndDate, $partyManagerId);
        return $party;
    }
}
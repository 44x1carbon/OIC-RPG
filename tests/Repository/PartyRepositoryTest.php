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
        $party = $this->sampleParty();
        $this->partyRepository->save($party);
        $findParty = $this->partyRepository->findById($party->id());

        $this->assertTrue($findParty->productionIdea() == $party->productionIdea());
    }


    function testFindById()
    {
        $party = $this->sampleParty();
        $this->partyRepository->save($party);
        $party2 = $this->sampleParty();
        $this->partyRepository->save($party2);
        $findParty = $this->partyRepository->findById($party->id());
        $this->assertTrue($findParty->activityEndDate() == $party->activityEndDate());
        $this->assertTrue(is_null($this->partyRepository->findById("hoge")));
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 11:30
 */

namespace Tests\Repository;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\Factory\PartyWrittenRequestFactory;
use App\Domain\PartyWrittenRequest\RepositoryInterface\PartyWrittenRequestRepositoryInterface;
use App\Domain\PartyWrittenRequest\ValueObject\ProductionIdeaInfo;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Domain\ProductionType\ProductionType;
use Tests\Sampler;
use Tests\TestCase;

class PartyWrittenRequestTest extends TestCase
{
    use Sampler;

    protected $partyWrittenRequestRepository;
    protected $partyWrittenRequestFactory;

    public function setUp()
    {
        parent::setUp();
        $this->partyWrittenRequestRepository = app(PartyWrittenRequestRepositoryInterface::class);
        $this->partyWrittenRequestFactory = app(PartyWrittenRequestFactory::class);
    }

/* partyWrittenRequest自体利用されていないため一時的にコメントアウト
    public function testSave()
    {
        $applicantId = new StudentNumber("B1111");
        $activityEndDate = new ActivityEndDate('1431670515');
        $productionIdeaInfo = new ProductionIdeaInfo("OICをRPG化", $this->sampleProductionType(), 'OIC専用のWantedlyを作成します');
        $wantedRoleInfoList[] = new WantedRoleInfo("Laravelエンジニア", "やれるやつ", "abcd",2);
        $partyWrittenRequest = $this->partyWrittenRequestFactory->createPartyWrittenRequest($applicantId, $activityEndDate, $productionIdeaInfo, $wantedRoleInfoList);
        $this->partyWrittenRequestRepository->save($partyWrittenRequest);

        $findPartyWrittenRequest = $this->partyWrittenRequestRepository->findById($partyWrittenRequest->id($partyWrittenRequest->id()));
        $this->assertTrue($findPartyWrittenRequest->productionIdeaInfo() === $partyWrittenRequest->productionIdeaInfo());
    }

    public function testFindById()
    {
        $id = "wxyz";
        $applicantId = new StudentNumber("B1111");
        $activityEndDate = new ActivityEndDate('1431670515');
        $productionIdeaInfo = new ProductionIdeaInfo("OICをRPG化", $this->sampleProductionType(), "制作物備考1");
        $wantedRoleInfoList[] = new WantedRoleInfo("Laravelエンジニア", "やれるやつ", "abcd",2);
        $partyWrittenRequest = $this->partyWrittenRequestFactory->createPartyWrittenRequest($applicantId, $activityEndDate, $productionIdeaInfo, $wantedRoleInfoList, $id);
        $this->partyWrittenRequestRepository->save($partyWrittenRequest);

        $applicantId2 = new StudentNumber("B2222");
        $activityEndDate2 = new ActivityEndDate('1431670515');
        $productionIdeaInfo2 = new ProductionIdeaInfo("Unityでげーむ", $this->sampleProductionType(), "制作物備考2");
        $wantedRoleInfoList2[] = new WantedRoleInfo("C#エンジニア", "ゲームが好きな人", "efgh",3);
        $partyWrittenRequest2 = $this->partyWrittenRequestFactory->createPartyWrittenRequest($applicantId2, $activityEndDate2, $productionIdeaInfo2, $wantedRoleInfoList2);
        $this->partyWrittenRequestRepository->save($partyWrittenRequest2);

        $findPartyWrittenRequest = $this->partyWrittenRequestRepository->findById($partyWrittenRequest->id('wxyz'));
        $this->assertTrue($findPartyWrittenRequest->productionIdeaInfo() === $partyWrittenRequest->productionIdeaInfo() && $findPartyWrittenRequest->applicantId() === $partyWrittenRequest->applicantId());

        $findPartyWrittenRequest2 = $this->partyWrittenRequestRepository->findById($partyWrittenRequest2->id());
        $this->assertTrue($findPartyWrittenRequest2->productionIdeaInfo() === $partyWrittenRequest2->productionIdeaInfo() && $findPartyWrittenRequest2->applicantId() === $partyWrittenRequest2->applicantId());

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->partyWrittenRequestRepository->findById('80') === null);
    }
*/
}
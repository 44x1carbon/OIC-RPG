<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:18
 */

namespace Tests\Repository;


use App\Domain\WantedMember\Factory\WantedMemberFactory;
use App\Domain\wantedMember\WantedMember;
use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use Tests\TestCase;

class WantedMemberRepositoryTest extends TestCase
{
    /* @var WantedMemberRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(WantedMemberRepositoryInterface::class);
    }

    public function testSave()
    {
        $id = "11";
        $wantedStatus = new WantedStatus("open");
        $wantedNumbers = 5;
        $remarks = "備考です";

        $wantedMemberFactory = new WantedMemberFactory();
        $wantedMember = $wantedMemberFactory->createwantedMember($id, $wantedStatus, $wantedNumbers, $remarks);
        $this->repo->save($wantedMember);

        $findWantedMember = $this->repo->findById($id);
        $afterRemarks = "改変した備考1です";
        $findWantedMember->setRemarks($afterRemarks);
        $this->repo->save($findWantedMember);

        $findAfterWantedMember = $this->repo->findById($id);
        $this->assertTrue($findAfterWantedMember->remarks() === $afterRemarks);
    }

    public function testFindById()
    {
        $wantedMemberFactory = new WantedMemberFactory();

        $id = "1";
        $wantedStatus = new WantedStatus("open");
        $wantedNumbers = 11;
        $remarks = "備考です1";

        $wantedMember = $wantedMemberFactory->createwantedMember($id, $wantedStatus, $wantedNumbers, $remarks);
        $this->repo->save($wantedMember);

        $id2 = "2";
        $wantedStatus2 = new WantedStatus("open");
        $wantedNumbers2 = 22;
        $remarks2 = "備考です2";

        $wantedMember2 = $wantedMemberFactory->createwantedMember($id2, $wantedStatus2, $wantedNumbers2, $remarks2);
        $this->repo->save($wantedMember2);

        $findWantedMember = $this->repo->findById('1');
        $result = $findWantedMember->Id() === $wantedMember->Id() && $findWantedMember->remarks() === $wantedMember->remarks();
        $this->assertTrue($result);

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->repo->findById('80') === null);
    }
}
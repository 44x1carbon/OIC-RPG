<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:18
 */

namespace Tests\Repository;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
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
        $officerId = new StudentNumber("B1111");

        $wantedMemberFactory = new WantedMemberFactory();
        $wantedMember = $wantedMemberFactory->createwantedMember($wantedStatus, $officerId, $id);
        $this->repo->save($wantedMember);

        $findWantedMember = $this->repo->findById($id);
        $afterWantedStatus = new WantedStatus("close");
        $findWantedMember->setWantedStatus($afterWantedStatus);
        $this->repo->save($findWantedMember);

        $findAfterWantedMember = $this->repo->findById($id);
        $this->assertTrue($findAfterWantedMember->wantedStatus() === $afterWantedStatus);
    }

    public function testFindById()
    {
        $wantedMemberFactory = new WantedMemberFactory();

        $id = "1";
        $wantedStatus = new WantedStatus("open");
        $officerId = new StudentNumber("B1111");

        $wantedMember = $wantedMemberFactory->createwantedMember($wantedStatus, $officerId, $id);
        $this->repo->save($wantedMember);

        $id2 = "2";
        $wantedStatus2 = new WantedStatus("open");
        $officerId2 = new StudentNumber("B2222");

        $wantedMember2 = $wantedMemberFactory->createwantedMember($wantedStatus2, $officerId2, $id2);
        $this->repo->save($wantedMember2);

        $findWantedMember = $this->repo->findById('1');
        $result = $findWantedMember->officerId() === $wantedMember->officerId();
        $this->assertTrue($result);

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->repo->findById('80') === null);
    }
}
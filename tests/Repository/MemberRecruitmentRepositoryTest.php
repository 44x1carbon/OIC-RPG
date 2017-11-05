<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:18
 */

namespace Tests\Repository;


use App\Domain\MemberRecruitment\Factory\MemberRecruitmentFactory;
use App\Domain\MemberRecruitment\MemberRecruitment;
use App\Domain\MemberRecruitment\RepositoryInterface\MemberRecruitmentRepositoryInterface;
use App\Domain\MemberRecruitment\ValueObjects\RecruitmentStatus;
use Tests\TestCase;

class MemberRecruitmentRepositoryTest extends TestCase
{
    /* @var MemberRecruitmentRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(MemberRecruitmentRepositoryInterface::class);
    }

    public function testSave()
    {
        $id = "11";
        $recruitmentStatus = new RecruitmentStatus("open");
        $recruitmentNumbers = 5;
        $remarks = "備考です";

        $memberRecruitmentFactory = new MemberRecruitmentFactory();
        $memberRecruitment = $memberRecruitmentFactory->createMemberRecruitment($id, $recruitmentStatus, $recruitmentNumbers, $remarks);
        $this->repo->save($memberRecruitment);

        $findMemberRecruitment = $this->repo->findById($id);
        $afterRemarks = "改変した備考1です";
        $findMemberRecruitment->setRemarks($afterRemarks);
        $this->repo->save($findMemberRecruitment);

        $findAfterMemberRecruitment = $this->repo->findById($id);
        $this->assertTrue($findAfterMemberRecruitment->remarks() === $afterRemarks);
    }

    public function testFindById()
    {
        $memberRecruitmentFactory = new MemberRecruitmentFactory();

        $id = "1";
        $recruitmentStatus = new RecruitmentStatus("open");
        $recruitmentNumbers = 11;
        $remarks = "備考です1";

        $memberRecruitment = $memberRecruitmentFactory->createMemberRecruitment($id, $recruitmentStatus, $recruitmentNumbers, $remarks);
        $this->repo->save($memberRecruitment);

        $id2 = "2";
        $recruitmentStatus2 = new RecruitmentStatus("open");
        $recruitmentNumbers2 = 22;
        $remarks2 = "備考です2";

        $memberRecruitment2 = $memberRecruitmentFactory->createMemberRecruitment($id2, $recruitmentStatus2, $recruitmentNumbers2, $remarks2);
        $this->repo->save($memberRecruitment2);

        $findMemberRecruitment = $this->repo->findById('1');
        $result = $findMemberRecruitment->Id() === $memberRecruitment->Id() && $findMemberRecruitment->remarks() === $memberRecruitment->remarks();
        $this->assertTrue($result);

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->repo->findById('80') === null);
    }
}
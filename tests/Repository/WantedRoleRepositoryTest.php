<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 15:24
 */

namespace Tests\Repository;


use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\WantedRole\Factory\WantedRoleFactory;
use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Domain\WantedRole\ValueObject\WantedMemberList;
use Tests\TestCase;

class WantedRoleRepositoryTest extends TestCase
{
    /* @var WantedMemberRepositoryInterface $wantedRoleRepository */
    protected $wantedRoleRepository;
    /* @var WantedRoleFactory $wantedRoleFactory */
    protected $wantedRoleFactory;

    public function setUp()
    {
        parent::setUp();
        $this->wantedRoleRepository = app(WantedRoleRepositoryInterface::class);
        $this->wantedRoleFactory = new WantedRoleFactory();

    }

    public function testSave()
    {
        $id = "11";
        $name = "Laravelエンジニア";
        $referenceJobId = "B1111";
        $remarks = "laravel5.5を使いたい人";
        $wantedMemberList = new WantedMemberList(["123"]);

        $wantedRole = $this->wantedRoleFactory->createWantedRole($name, $referenceJobId, $remarks, $wantedMemberList, $id);
        $this->wantedRoleRepository->save($wantedRole);

        $findWantedRole = $this->wantedRoleRepository->findById($id);
        $this->wantedRoleRepository->save($findWantedRole);

        $findAfterWantedRole = $this->wantedRoleRepository->findById($id);
        $this->assertTrue($findAfterWantedRole->remarks() === $remarks);
    }

    public function testFindById()
    {

        $id = "1";
        $name = "Laravelエンジニア";
        $referenceJobId = "B1111";
        $remarks = "laravel5.5を使いたい人";
        $wantedMemberList = new WantedMemberList(["123"]);;

        $wantedRole = $this->wantedRoleFactory->createWantedRole($name, $referenceJobId, $remarks, $wantedMemberList, $id);
        $this->wantedRoleRepository->save($wantedRole);

        $id2 = "2";
        $name2 = "Vuejsエンジニア";
        $referenceJobId2 = "B2222";
        $remarks2 = "vuejsを使いたい人";
        $wantedMemberList2 = new WantedMemberList(["456"]);;

        $wantedRole2 = $this->wantedRoleFactory->createWantedRole($name2, $referenceJobId2, $remarks2, $wantedMemberList2, $id2);
        $this->wantedRoleRepository->save($wantedRole2);

        $findWantedRole = $this->wantedRoleRepository->findById('1');
        $result = $findWantedRole->remarks() === $wantedRole->remarks();
        $this->assertTrue($result);

        // 指定したIDがなかった場合にnullが帰るかどうか
        $this->assertTrue($this->wantedRoleRepository->findById('80') === null);
    }
}
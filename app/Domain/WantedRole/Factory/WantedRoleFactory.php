<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 12:17
 */

namespace App\Domain\WantedRole\Factory;


use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Domain\WantedRole\ValueObject\WantedMemberList;
use App\Domain\WantedRole\WantedRole;
use App\DomainUtility\RandomStringGenerator;

class WantedRoleFactory
{
    private $wantedRoleRepository;

    public function __construct()
    {
        $this->wantedRoleRepository = app(WantedRoleRepositoryInterface::class);
    }

//    ToDo WantedMemberList VOに置き換え
    public function createWantedRole(String $name, String $referenceJobId, String $remarks, WantedMemberList $wantedMemberList, String $id = null): WantedRole
    {
        $wantedRole = new WantedRole();
        $wantedRole->setId($id ?? $this->makeId());
        $wantedRole->setName($name);
        $wantedRole->setReferenceJobId($referenceJobId);
        $wantedRole->setRemarks($remarks);
        $wantedRole->setWantedMemberList($wantedMemberList);
        return $wantedRole;
    }

    public function makeId()
    {
        $randId = RandomStringGenerator::makeLowerCase(4);
        $reCreateIdFlg = true;
        do {
            if (is_null($this->wantedRoleRepository->findById($randId))){
                // findByIdがnullの場合、DBにIDのかぶりがないので正しい
                $reCreateIdFlg = false;
            }else{
                $randId = RandomStringGenerator::makeLowerCase(4);
            }
        } while ($reCreateIdFlg);
        return $randId;
    }
}
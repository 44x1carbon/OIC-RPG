<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 15:25
 */

namespace App\Infrastracture\WantedRole;


use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Domain\WantedRole\WantedRole;

class WantedRoleOnMemoryRepositoryImpl implements WantedRoleRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?WantedRole
    {
        $result = array_filter($this->data, function (WantedRole $wantedRole) use ($id) {
            return $wantedRole->id() == $id;
        });

        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(WantedRole $wantedRole): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataWantedRole) {
            if ($dataWantedRole->id() === $wantedRole->id()) {
                $this->data[$key] = $wantedRole;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg) {
            $this->data[] = $wantedRole;
        }
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}
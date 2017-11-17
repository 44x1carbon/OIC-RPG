<?php

namespace App\Domain\WantedRole\ValueObject;

use App\Domain\WantedMember\Factory\WantedMemberFactory;
use App\Domain\WantedMember\WantedMember;

class WantedMemberList
{
    /* @var WantedMemberFactory $wantedMemberFactory */
    protected $wantedMemberFactory;
    protected $wantedMemberList;

    /**
     * WantedMemberList constructor.
     * @param WantedMember[] $wantedMemberList
     */
    function __construct(array $wantedMemberList = [])
    {
        $this->wantedMemberList = $wantedMemberList;
        $this->wantedMemberFactory = app(WantedMemberFactory::class);
    }

    public function addFrame(int $frameAmount)
    {
        for ($i=0;$i<$frameAmount;$i++) {
            $this->wantedMemberList[] = $this->wantedMemberFactory->createWantedMember();
        }
    }

    public function findById(string $id): ?WantedMember
    {
        $result = array_filter($this->wantedMemberList, function(WantedMember $wantedMember) use($id){
            return $wantedMember->id() === $id;
        });

        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function all(): array
    {
        return $this->wantedMemberList;
    }

    public function save(WantedMember $wantedMember): bool
    {
        $findKey = null;
        foreach ($this->wantedMemberList as $key => $dataWantedMember){
            if ($dataWantedMember->id() === $wantedMember->id()){
                $findKey = $key;
            }
        }
        // 既に存在していた場合は上書きし、なければ新規で追加する
        if ($findKey !== null) {
            $this->wantedMemberList[$findKey] = $wantedMember;
        }else{
            $this->wantedMemberList[] = $wantedMember;
        }
        return true;
    }
}
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
        // ToDo $frameAmount分 $wantedMemberListにWantedMemberを追加する
        // WantedStatus: WantedStatus::OPEN, officerId: null

        for ($i=0;$i<$frameAmount;$i++) {
            $this->wantedMemberList[] = $this->wantedMemberFactory->createWantedMember();
        }
    }

    public function findById(string $id): ?WantedMember
    {
        // ToDo 指定されたIDのWantedMemberを返す

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
        // ToDo 全て返す
        return $this->wantedMemberList;
    }

    public function save(WantedMember $wantedMember): bool
    {
        // ToDo 受け取ったWantedMemberを追加、すでに存在しているときは更新する
        $findKey = false;
        foreach ($this->wantedMemberList as $key => $dataWantedMember){
            if ($dataWantedMember->id() === $wantedMember->id()){
                $findKey = $key;
            }
        }
        // 既に存在していた場合は上書きし、なければ新規で追加する
        if ($findKey) {
            $this->wantedMemberList[$findKey] = $wantedMember;
        }else{
            $this->wantedMemberList[] = $wantedMember;
        }
        return true;
    }
}
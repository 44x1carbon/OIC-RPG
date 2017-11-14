<?php

namespace App\Domain\WantedRole\ValueObject;

use App\Domain\WantedMember\WantedMember;

class WantedMemberList
{
    protected $wantedMemberList;

    function __construct(array $wantedMemberList = [])
    {
        $this->wantedMemberList = $wantedMemberList;
    }

    public function addFrame(int $frameAmount)
    {
        // ToDo $frameAmount分 $wantedMemberListにWantedMemberを追加する
        // WantedStatus: WantedStatus::OPEN, officerId: null
    }

    public function findById(string $id): WantedMember
    {
        // ToDo 指定されたIDのWantedMemberを返す
    }

    public function all(): array
    {
        // ToDo 全て返す
    }

    public function save(WantedMember $wantedMember): bool
    {
        // ToDo 受け取ったWantedMemberを追加、すでに存在しているときは更新する
    }
}
<?php

namespace App\Domain\WantedRole\ValueObject;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedMember\Factory\WantedMemberFactory;
use App\Domain\WantedMember\Spec\WantedMemberSpec;
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
            $this->wantedMemberList[] = new WantedMember($this->nextWantedMemberId());
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

    public function assignableList(): array
    {
        return array_values(array_filter($this->all(), function(WantedMember $wantedMember) {
           return WantedMemberSpec::isAssignable($wantedMember);
        }));
    }

    private function nextWantedMemberId(): string
    {
        return (string) (count($this->all()) + 1);
    }

    public function assignedList(): array
    {
        return array_values(array_filter($this->all(), function(WantedMember $wantedMember) {
            return WantedMemberSpec::isAssigned($wantedMember);
        }));
    }

    public function isOfficerId(StudentNumber $officerId): bool
    {
        foreach ($this->all() as $wantedMember) {
            if(!is_null($wantedMember->officerId()) && $officerId->equals($wantedMember->officerId())) return true;
        }
        return false;
    }
}
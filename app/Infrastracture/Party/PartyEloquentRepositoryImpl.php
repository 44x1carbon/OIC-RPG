<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/07
 * Time: 16:00
 */

namespace App\Infrastracture\Party;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\WantedMember\WantedMember;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\PartyEloquent;
use App\Eloquents\ProductionIdeaEloquent;
use App\Eloquents\ProductionTypeEloquent;
use App\Eloquents\WantedMemberEloquent;
use App\Eloquents\WantedRoleEloquent;

class PartyEloquentRepositoryImpl implements PartyRepositoryInterface
{
    protected $eloquent;

    public function __construct(PartyEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(string $id): ?Party
    {
        return null_safety($this->eloquent->where('party_id', $id)->first(), function(PartyEloquent $model) {
            return $model->toEntity();
        });
    }

    public function findListByManagerId(StudentNumber $managerId): ?array
    {
        return $this->eloquent->where('manager_id', $managerId->code())->get()->map(function(PartyEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

    public function findListByOfficerId(StudentNumber $officerId): ?array
    {
        $partyList = $this->all();
        $officerParties = array_filter($partyList, function ($party) use($officerId) {
            $result = false;
            foreach ($party->partyMembers() as $partyMember) {
                if ($officerId->equals($partyMember->memberId())) {
                    $result = true;
                }
            }
            return $result;
        });

        return $officerParties;
    }

    public function save(Party $party): bool
    {
        return PartyEloquent::saveDomainObject($party);
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(PartyEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

    public function nextId(): string
    {
        do {
            $randId = RandomStringGenerator::makeLowerCase(4);
        } while ($this->eloquent->where('party_id', $randId)->first());
        return $randId;
    }

    /**
     * 最新のパーティを引数で渡された数だけ取得する
     */
    public function takeNewParty(int $n): array
    {
        return $this->eloquent->orderBy('created_at', 'desc')->take($n)->get()->map(function(PartyEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

}
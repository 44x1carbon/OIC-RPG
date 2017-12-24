<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/07
 * Time: 16:00
 */

namespace App\Infrastracture\Party;


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

}
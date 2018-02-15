<?php

namespace App\Infrastracture\Scout;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Scout\Scout;
use App\Domain\Scout\ScoutRepositoryInterface;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\ScoutEloquent;

class ScoutEloquentRepositoryImpl implements ScoutRepositoryInterface
{
    private $eloquent;

    function __construct(ScoutEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function nextId(): string
    {
        do {
            $id = RandomStringGenerator::makeLowerCase(8);

            $model = $this->eloquent->where('scout_id', $id)->first();
        } while($model != null);
      
        return $id;
    }

    public function save(Scout $scout): bool
    {
        return $this->eloquent->fromEntity($scout)->save();
    }

    public function findByTo(StudentNumber $to): array
    {
        return $this->eloquent->where('to', $to->code())
            ->get()
            ->map(function(ScoutEloquent $model) {
                return $model->toEntity();
            })
            ->toArray();
    }

    public function findByFrom(StudentNumber $from): array
    {
        return $this->eloquent->where('from', $from->code())
            ->get()
            ->map(function(ScoutEloquent $model) {
                return $model->toEntity();
            })
            ->toArray();
    }

    public function findByPartyId(string $partyId): array
    {
        return $this->eloquent->where('party_id', $partyId)
            ->get()
            ->map(function(ScoutEloquent $model) {
                return $model->toEntity();
            })
            ->toArray();
    }

    public function findById(string $id): ?Scout
    {
        return null_safety($this->eloquent->first(['scout_id', $id]), function(ScoutEloquent $model) {
           return $model->toEntity();
        });
    }
}
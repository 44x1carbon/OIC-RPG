<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Scout\Scout;
use Illuminate\Database\Eloquent\Model;

class ScoutEloquent extends Model
{
    protected $table = 'scouts';

    public function fromEntity(Scout $scout): ScoutEloquent
    {
        $model = self::where('scout_id', $scout->id)->firstOrNew([]);
        $model->scout_id = $scout->id;
        $model->to = $scout->to->code();
        $model->from = $scout->from->code();
        $model->party_id = $scout->partyId;
        $model->message = $scout->message;
        $model->send_at = $scout->send_at;

        return $model;
    }

    public function toEntity(): Scout
    {
        return new Scout(
            $this->scout_id,
            new StudentNumber($this->to),
            new StudentNumber($this->from),
            $this->party_id,
            $this->message,
            $this->send_at
        );
    }
}

<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class FieldSkillIdEloquent extends Model
{
    protected $table = 'field_skills';

    public function toVo(): string
    {
        return $this->skill_id;
    }
}

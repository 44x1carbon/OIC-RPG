<?php

namespace App\Domain\Status\Eloquents;

use Illuminate\Database\Eloquent\Model;

class SkillEloquent extends Model
{
    protected $table = "skills";

    public function findCode(string $code):SkillEloquent
    {
        return $this->where("skill_code", $code)->first();
    }
}

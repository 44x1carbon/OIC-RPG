<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\SkillEloquent;

class SkillRepository
{
    protected $skillModel;

    function __construct(SkillEloquent $skillModel)
    {
        $this->skillModel = $skillModel;
    }

    public function findCode(string $code):SkillEloquent
    {
        return $this->skillModel->where("skill_code", $code)->first();
    }
}
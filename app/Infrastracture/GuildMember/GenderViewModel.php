<?php

namespace App\Infrastracture\GuildMember;


use App\Domain\GuildMember\ValueObjects\Gender;

class GenderViewModel
{
    /**
     * GenderViewModel constructor.
     * @param \App\Domain\GuildMember\ValueObjects\Gender $gender
     */
    public function __construct(Gender $gender)
    {
        $this->gender = $gender->type();
    }

    /**
     * @return string
     */
    public function toJa(): string
    {
        switch ($this->gender) {
            case Gender::MALE : return '男'; break;
            case Gender::FEMALE : return '女'; break;
        }
    }
}

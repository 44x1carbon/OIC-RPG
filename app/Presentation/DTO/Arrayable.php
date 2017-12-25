<?php

namespace App\Presentation\DTO;

interface Arrayable
{
    public function toArray(): array;

    public static function fromArray(array $data);
}
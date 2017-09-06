<?php

namespace App\Domain\Common\Student;

class StudentFactory
{
    protected $repo;

    function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function make()
    {

    }
}
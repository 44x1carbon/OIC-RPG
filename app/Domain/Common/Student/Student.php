<?php

namespace App\Domain\Common\Student;

use App\Domain\Common\Student\ValueObjects\StudentIdentifier;
use App\Domain\Utilities\Entity\AbstractEntity;


class Student extends AbstractEntity
{
    protected $attributes = [
        'studentCode', 'name'
    ];
    protected $fillable = [
        'studentCode',
    ];
    protected $identifierKeys = [
        'studentCode', 'name'
    ];
    protected $repositories = [
        StudentRepository::class,
    ];

    public function getIdentifier(): StudentIdentifier
    {
        $data = $this->getIdentifierData();
        return new StudentIdentifier($data);
    }

    public function equal(StudentIdentifier $id): bool
    {
        return parent::_equal($id);
    }
}
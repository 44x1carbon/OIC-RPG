<?php

namespace Tests\Domain;

use App\Domain\Field\Field;
use App\Domain\Field\FieldRepositoryInterface;
use Tests\TestCase;

class FieldBehaviorTest extends TestCase
{
    /* @var FieldRepositoryInterface $repo */
    private $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(FieldRepositoryInterface::class);
    }

    public function testDefaultJob()
    {
        foreach (Field::DEFAULT_JOB_LIST as $fieldName => $defaultJobName) {
            /* @var Field $field */
            $field = $this->repo->findByName($fieldName);

            $defaultJob = $field->defaultJob();

            $this->assertTrue($defaultJob->jobName() == $defaultJobName);
        }

    }
}
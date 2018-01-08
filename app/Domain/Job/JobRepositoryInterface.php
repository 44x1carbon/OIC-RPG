<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/05
 * Time: 18:39
 */

namespace App\Domain\Job;


use App\Domain\Job\ValueObjects\JobId;

interface JobRepositoryInterface
{
    public function findById(string $code): ?Job;

    public function findByName(string $name): ?Job;

    public function nextId(): JobId;

    public function save(Job $job): bool;

    public function all(): array;

    public function exceptStudent(): array;
}
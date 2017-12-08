<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/08
 * Time: 11:48
 */

namespace App\Domain\Job\Spec;

use App\Domain\Job\JobRepositoryInterface;

class JobIdSpec
{
    protected $repo;

    public function isExistCode(string $code): bool
    {
        /* @var JobRepositoryInterface $repo */
        $repo = app(JobRepositoryInterface::class);
        return is_null($repo->findByCode($code));
    }
}
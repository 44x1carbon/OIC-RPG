<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 11:24
 */

namespace App\Domain\Course\Spec;

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use App\DomainUtility\SpecTrait;

class CourseSpec
{
    use SpecTrait;

    public static function isExistCode(String $code): bool
    {
        /* @var CourseRepositoryInterface $repo */
        $repo = app(CourseRepositoryInterface::class);
        $course = $repo->findById($code);
        return $course !== null;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 14:42
 */

namespace App\Domain\Course\RepositoryInterface;


use App\Domain\Course\Course;

interface CourseRepositoryInterface
{
//IDを渡してコースを受け取る
    public function findById(String $id): Course;

    public function save(Course $course): bool;

    public function all(): Array;
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 14:33
 */

namespace App\Domain\Course;


use PhpParser\Node\Scalar\String_;

class Course
{
    private $id;
    private $courseName;

    public function __construct(String $id,String $courseName)
    {
        $this->id = $id;
        $this->courseName = $courseName;
    }

    public function id(): String
    {
        return $this->id;
    }

    public function courseName(): String
    {
        return $this->courseName;
    }

}
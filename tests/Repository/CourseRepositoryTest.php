<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 15:05
 */

namespace Tests\Repository;


use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CourseRepositoryTest extends TestCase
{
    /* @var CourseRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(CourseRepositoryInterface::class);
    }

    public function testSave()
    {
        $course = new Course('1','aaa');
        $this->repo->save($course);
        $this->assertTrue(true);
    }

    public function testFindById()
    {
        $course = new Course('2','bbb');
        $this->repo->save($course);
        $course2 = new Course('3','ccc');
        $this->repo->save($course2);
        $findCourse = $this->repo->findById('2');
        $result = $findCourse->id() === $course->id() && $findCourse->courseName() === $course->courseName();
        $this->assertTrue($result);
    }
}
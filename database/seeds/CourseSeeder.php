<?php

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /* @var CourseRepositoryInterface $repo */
    protected $repo;

    function __construct()
    {
        $this->repo = app(CourseRepositoryInterface::class);
    }

    public function run()
    {
        $this->repo->save(new Course('1', 'コース1'));
        $this->repo->save(new Course('2', 'コース2'));
    }
}
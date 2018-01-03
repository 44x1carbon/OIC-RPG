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
use App\Domain\Field\Field;
use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class FieldRepositoryTest extends TestCase
{
    /* @var FieldRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(FieldRepositoryInterface::class);
    }

    public function testSave()
    {
        $field = new Field('IT',[new JobId('aaaa')], ['bbbb']);
        $this->repo->save($field);
        $this->assertTrue(true);
    }

    public function testFindByName()
    {
        $field = new Field('IT',[new JobId('aaaa')], ['bbbb']);
        $this->repo->save($field);
        $field2 = new Field('デザイン',[new JobId('cccc')], ['dddd']);
        $this->repo->save($field2);

        $findField = $this->repo->findByName('IT');

        $this->assertTrue($findField->name() === $field->name());
        $this->assertTrue($findField->jobIdList()[0] == $field->jobIdList()[0]);
        $this->assertTrue($findField->courseIdList()[0] == $field->courseIdList()[0]);
    }

    public function testFindByJobId()
    {
        $field = new Field('IT',[new JobId('aaaa')], ['bbbb']);
        $this->repo->save($field);
        $field2 = new Field('デザイン',[new JobId('cccc')], ['dddd']);
        $this->repo->save($field2);

        $findField = $this->repo->findByJobId(new JobId('aaaa'));

        $this->assertTrue($findField->name() === $field->name());
        $this->assertTrue($findField->jobIdList()[0] == $field->jobIdList()[0]);
        $this->assertTrue($findField->courseIdList()[0] == $field->courseIdList()[0]);
    }

    public function testFindByCourseId()
    {
        $field = new Field('IT',[new JobId('aaaa')], ['bbbb']);
        $this->repo->save($field);
        $field2 = new Field('デザイン',[new JobId('cccc')], ['dddd']);
        $this->repo->save($field2);

        $findField = $this->repo->findByCourseId('bbbb');

        $this->assertTrue($findField->name() === $field->name());
        $this->assertTrue($findField->jobIdList()[0] == $field->jobIdList()[0]);
        $this->assertTrue($findField->courseIdList()[0] == $field->courseIdList()[0]);
    }
}
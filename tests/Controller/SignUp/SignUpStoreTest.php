<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/17
 * Time: 12:44
 */

namespace Tests\Controller\SignUp;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use Tests\TestCase;

class SignUpStoreTest extends TestCase
{

    /* @var CourseRepositoryInterface $courseRepo */
    private $courseRepo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->courseRepo = app(CourseRepositoryInterface::class);
    }

    public function testSuccess()
    {
        $response = $this->post(route('post_sign_up'),[
            'student_number' => 'B4000',
            'name' => 'テスト太郎',
            'course_id' => array_random($this->courseRepo->all())->id(),
            'gender' => 'male',
            'mail_address' => 'B4000@oic.jp',
            'password' => 'testPassword',
        ]);

        $response->assertStatus(200);
    }
}
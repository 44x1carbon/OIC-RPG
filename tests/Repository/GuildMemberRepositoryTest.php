<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 16:00
 */

namespace Tests\Repository;


use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use Tests\TestCase;

class GuildMemberRepositoryTest extends TestCase
{
    /* @var GuildMemberRepositoryInterface $repo */
    protected $repo;
    /* @var CourseRepositoryInterface $courseRepo */
    protected $courseRepo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(GuildMemberRepositoryInterface::class);
        $this->courseRepo = app(CourseRepositoryInterface::class);
        $course = new Course('1','ITスペシャリスト');
        $this->courseRepo->save($course);
        $course = new Course('2','映像コース');
        $this->courseRepo->save($course);
        $course = new Course('3','ほげほげコース');
        $this->courseRepo->save($course);
    }

    public function testSave()
    {
        $studentNumber = new StudentNumber('B4000');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');
        $guildMemberFactory = new GuildMemberFactory();
        $guildMember = $guildMemberFactory->createGuildMember($studentNumber, $studentName, $course, $gender, $mailAddress);
        $this->repo->save($guildMember);
        $this->assertTrue(true);
    }

    public function testFindByStudentNumber()
    {
        $studentNumber = new StudentNumber('B4001');
        $studentName = 'やまごん';
        $course = new Course('2','映像コース');
        $gender = new Gender('female');
        $mailAddress = new MailAddress('b4001@oic.jp');
        $guildMemberFactory = new GuildMemberFactory();
        $guildMember = $guildMemberFactory->createGuildMember($studentNumber, $studentName, $course, $gender, $mailAddress);
        $this->repo->save($guildMember);


        $studentNumber2 = new StudentNumber('B4002');
        $studentName2 = 'よっしー';
        $course2 = new Course('3','ほげほげコース');
        $gender2 = new Gender('male');
        $mailAddress2 = new MailAddress('b4002@oic.jp');
        $guildMemberFactory2 = new GuildMemberFactory();
        $guildMember2 = $guildMemberFactory2->createGuildMember($studentNumber2, $studentName2, $course2, $gender2, $mailAddress2);
        $this->repo->save($guildMember2);

        $findGuildMember = $this->repo->findByStudentNumber($studentNumber);
        //dd($findGuildMember);
        $result = $findGuildMember->studentNumber() == $studentNumber && $findGuildMember->studentName() == $studentName &&
            $findGuildMember->course() == $course && $findGuildMember->gender() == $gender && $findGuildMember->mailAddress() == $mailAddress;
        $this->assertTrue($result);
    }
}
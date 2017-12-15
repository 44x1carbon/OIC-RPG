<?php

use App\Domain\Course\Course;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Infrastracture\GuildMember\GuildMemberOnMemoryRepositoryImpl;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 12:19
 */


class GuildMemberSpecTest extends \Tests\TestCase
{
    protected $repo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(GuildMemberRepositoryInterface::class);
        $studentNumber = new StudentNumber('B4000');
        $studentName = '新原佑亮';
        $course = new Course('1','ITスペシャリスト');
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');
        $guildMemberFactory = new GuildMemberFactory();
        $guildMember = $guildMemberFactory->createGuildMember($studentNumber, $studentName, $course, $gender, $mailAddress);
        $this->repo->save($guildMember);
    }

    function testSuccess()
    {
        $studentNumber = new StudentNumber('B4000');
        $this->assertTrue(GuildMemberSpec::isExistStudentNumber($studentNumber));

        $this->assertTrue(GuildMemberSpec::isCompleteItem($this->repo->findByStudentNumber($studentNumber)));
    }


    function testFail()
    {
        $studentNumber = new StudentNumber('B1111');
        $this->assertFalse(GuildMemberSpec::isExistStudentNumber($studentNumber));

        $this->assertFalse(GuildMemberSpec::isCompleteItem(new GuildMember()));
    }
}

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
use Tests\SampleGuildMember;
use Tests\TestCase;
use App\Domain\PossessionSkill\PossessionSkillCollection;

class GuildMemberRepositoryTest extends TestCase
{
    /* @var GuildMemberRepositoryInterface $repo */
    protected $repo;
    /* @var CourseRepositoryInterface $courseRepo */
    protected $courseRepo;
    /* @var SkillFactory $skillFactory */
    protected $skillFactory;
    /* @var Skill $skill */
    protected $skill;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->repo = app(GuildMemberRepositoryInterface::class);
        $this->courseRepo = app(CourseRepositoryInterface::class);        

        $course = new Course('1', 'ITスペシャリスト');
        $this->courseRepo->save($course);
        $course = new Course('2', '映像コース');
        $this->courseRepo->save($course);
        $course = new Course('3', 'ほげほげコース');
        $this->courseRepo->save($course);        
    }

    public function testSave()
    {
        $studentNumber = new StudentNumber('B4000');
        $studentName = '新原佑亮';
        $gender = new Gender('male');
        $mailAddress = new MailAddress('b4000@oic.jp');

        $guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::studentName => $studentName,
            SampleGuildMember::gender => $gender,
            SampleGuildMember::mailAddress => $mailAddress,
        ]);

        $this->repo->save($guildMember);
        $this->assertTrue(true);
    }

    public function testFindByStudentNumber()
    {
        $studentNumber = new StudentNumber('B4001');
        $studentName = 'やまごん';
        $gender = new Gender('female');
        $mailAddress = new MailAddress('b4001@oic.jp');
        $guildMember = $guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::studentName => $studentName,
            SampleGuildMember::gender => $gender,
            SampleGuildMember::mailAddress => $mailAddress,
        ]);
        $this->repo->save($guildMember);


        $studentNumber2 = new StudentNumber('B4002');
        $studentName2 = 'よっしー';
        $gender2 = new Gender('male');
        $mailAddress2 = new MailAddress('b4002@oic.jp');
        $guildMember2 = $guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber2,
            SampleGuildMember::studentName => $studentName2,
            SampleGuildMember::gender => $gender2,
            SampleGuildMember::mailAddress => $mailAddress2,
        ]);
        $this->repo->save($guildMember2);

        $findGuildMember = $this->repo->findByStudentNumber($guildMember->studentNumber());
        //dd($findGuildMember);
        $result = $findGuildMember->studentNumber() == $guildMember->studentNumber() && $findGuildMember->studentName() == $guildMember->studentName() &&
            $findGuildMember->course() == $guildMember->course() && $findGuildMember->gender() == $guildMember->gender() && $findGuildMember->mailAddress() == $guildMember->mailAddress();
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $studentNumber = new StudentNumber('B5000');
        $studentName = 'くさかべ';
        $gender = new Gender('female');
        $mailAddress = new MailAddress('b5000@oic.jp');
        $guildMember = $guildMember = $this->sampleGuildMember([
            SampleGuildMember::studentNumber => $studentNumber,
            SampleGuildMember::studentName => $studentName,
            SampleGuildMember::gender => $gender,
            SampleGuildMember::mailAddress => $mailAddress,
        ]);
        $this->repo->save($guildMember);

        $findGuildMember = $this->repo->findByStudentNumber($guildMember->studentNumber());
        $this->repo->delete($guildMember);
        $findDeleteGuildMember = $this->repo->findByStudentNumber($guildMember->studentNumber());

        // DBから取得できたIDが削除して取れなくなってnullを返していることをチェック
        $this->assertTrue(isset($findGuildMember)&&is_null($findDeleteGuildMember));
    }
}

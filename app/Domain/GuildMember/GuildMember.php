<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:30
 */

namespace App\Domain\GuildMember;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\Course\Course;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use ArrayObject;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Scalar\String_;


class GuildMember
{
    /* @var \App\Domain\Course\RepositoryInterface\CourseRepositoryInterface */
    protected $courseRepo;
    private $studentNumber;
    private $studentName;
    private $courseId;
    private $gender;
    private $mailAddress;
    private $possessionSkillCollection;

    public function __construct()
    {
        $this->courseRepo = app(CourseRepositoryInterface::class);
    }

//  学籍番号VOをセット
    public function setStudentNumber(StudentNumber $studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

//  学生の名前をセット
    public function setStudentName(string $studentName)
    {
        $this->studentName = $studentName;
    }
//  コースIDをセット
    public function setCourse(Course $course)
    {
        $this->courseId = $course->id();
    }

//  学生の性別をセット
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

//  メールアドレスをセット
    public function setMailAddress(MailAddress $mailAddress)
    {
        $this->mailAddress = $mailAddress;
    }

    public function setPossessionSkill(PossessionSkillCollection $possessionSkillCollection)
    {
        $this->possessionSkillCollection = $possessionSkillCollection;
    }

//  学籍番号をゲット
    public function studentNumber(): StudentNumber
    {
        return $this->studentNumber;
    }

//  名前をゲット
    public function studentName(): string
    {
        return $this->studentName;
    }

//  最新コースをゲット
    public function course(): Course
    {
        //dd($this->courseId);
        return $this->courseRepo->findById($this->courseId);
    }

//  性別をゲット
    public function gender(): Gender
    {
        return $this->gender;
    }

//  メールアドレスをゲット
    public function mailAddress(): MailAddress
    {
        return $this->mailAddress;
    }

    public function possessionSkill(): PossessionSkillCollection
    {
        return $this->possessionSkillCollection;
    }
}
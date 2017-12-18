<?php

namespace App\Eloquents;

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use Illuminate\Database\Eloquent\Model;

class GuildMemberEloquent extends Model
{
    //
    protected $table = 'guild_members';

    /* @var GuildMemberFactory $factory */
    protected $factory;
    /* @var CourseRepositoryInterface $courseRepository */
    protected $courseRepository;

    function __construct()
    {
        $this->factory = app(GuildMemberFactory::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function findByStudentNumber(StudentNumber $studentNumber): ?GuildMemberEloquent
    {
        $guildMemberModel = $this->where('student_number', $studentNumber->code())->first();
        return $guildMemberModel;
    }

    public function toEntity(): GuildMember
    {
        $guildMember = $this->factory->createGuildMember(
            $this->studentNumber(),
            $this->studentName(),
            $this->course(),
            $this->gender(),
            $this->mailAddress()
        );

        $possessionSkillEloquent = new PossessionSkillEloquent();
        $possessionSkills = $possessionSkillEloquent->findByStudentNumber($this->studentNumber());
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $guildMember->setPossessionSkills($possessionSkillCollection);
        return $guildMember;
    }

    public function studentNumber(): StudentNumber
    {
        return new StudentNumber($this->student_number);
    }

    public function studentName(): String
    {
        return $this->name;
    }

    public function course(): Course
    {
        return $this->courseRepository->findById($this->course_id);
    }

    public function gender(): Gender
    {
        return new Gender($this->gender_type);
    }

    public function mailAddress(): MailAddress
    {
        return new MailAddress($this->email);
    }
}

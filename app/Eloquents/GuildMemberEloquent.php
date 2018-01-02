<?php

namespace App\Eloquents;

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Exceptions\DomainException;
use Illuminate\Database\Eloquent\Model;

class GuildMemberEloquent extends Model
{
    //
    protected $table = 'guild_members';

    /* @var GuildMemberFactory $factory */
    protected $factory;
    /* @var CourseRepositoryInterface $courseRepository */
    protected $courseRepository;
    /* @var PossessionSkillEloquent $possessionSkillEloquent */
    protected $possessionSkillEloquent;
    /* @var PossessionJobEloquent $possessionJobEloquent */
    protected $possessionJobEloquent;

    function __construct()
    {
        $this->factory = app(GuildMemberFactory::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->possessionSkillEloquent = new PossessionSkillEloquent();
        $this->possessionJobEloquent = new PossessionJobEloquent();
    }

    public function findByStudentNumber(StudentNumber $studentNumber): ?GuildMemberEloquent
    {
        $guildMemberModel = $this->where('student_number', $studentNumber->code())->first();
        return $guildMemberModel;
    }

    public function  fromEntity(GuildMember $guildMember): GuildMemberEloquent
    {
        // Eloquentを使ってEntityから永続化されたモデルを取得する
        $guildMemberModel = $this->findByStudentNumber($guildMember->studentNumber());
        if ($guildMemberModel) {
            return $guildMemberModel;
        }

        // 受け取ったEntityの項目が完全であれば、Eloquentモデルに変換して返す
        if (GuildMemberSpec::isCompleteItem($guildMember)) {
            $guildMemberModel = new $this;
            $guildMemberModel->studentNumber = $guildMember->studentNumber();
            $guildMemberModel->studentName = $guildMember->studentName();
            $guildMemberModel->course = $guildMember->course();
            $guildMemberModel->gender = $guildMember->gender();
            $guildMemberModel->mailAddress = $guildMember->mailAddress();
            $guildMemberModel->favorite_job_id = $guildMember->favoriteJobId()->code();
            return $guildMemberModel;
        }else{
            // 不完全なEntityだった場合はDomainException
            throw new DomainException("Error");
        }
    }

    public function toEntity(): GuildMember
    {
        $possessionSkills = $this->possessionSkillEloquent::findByStudentNumber($this->studentNumber());
        $possessionSkillCollection = new PossessionSkillCollection($possessionSkills);

        $possessionJobs = $this->possessionJobEloquent::findByStudentNumber($this->studentNumber());
        $possessionJobCollection = new PossessionJobCollection($possessionJobs);

        $guildMember = $this->factory->createGuildMember(
            $this->studentNumber(),
            $this->studentName(),
            $this->course(),
            $this->gender(),
            $this->mailAddress(),
            null_safety($this->favorite_job_id, function($favorite_job_id) {
                return new JobId($favorite_job_id);
            }),
            $possessionSkillCollection,
            $possessionJobCollection
        );
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

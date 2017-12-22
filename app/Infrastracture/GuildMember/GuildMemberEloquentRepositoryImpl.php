<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 11:21
 */

namespace App\Infrastracture\GuildMember;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Eloquents\GuildMemberEloquent;
use App\Eloquents\PossessionSkillEloquent;

class GuildMemberEloquentRepositoryImpl implements GuildMemberRepositoryInterface
{
    protected $eloquent;

    function __construct(GuildMemberEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findByStudentNumber(StudentNumber $studentNumber): ?GuildMember
    {
        $guildMemberModel = $this->eloquent->findByStudentNumber($studentNumber);
        if(is_null($guildMemberModel)) return null;
        return $guildMemberModel->toEntity();
    }

    public function save(GuildMember $guildMember): bool
    {
        /* @var GuildMemberEloquent $guildMemberModel */
        $studentNumber = $guildMember->studentNumber();
        $guildMemberModel = $this->eloquent->findByStudentNumber($studentNumber);
        if(is_null($guildMemberModel)) $guildMemberModel = new $this->eloquent();

        $guildMemberModel->student_number = $studentNumber->code();
        $guildMemberModel->name = $guildMember->studentName();
        $guildMemberModel->course_id = $guildMember->course()->id();
        $guildMemberModel->gender_type = $guildMember->gender()->type();
        $guildMemberModel->email = $guildMember->mailAddress()->address();

        PossessionSkillEloquent::saveManyDomainObject($guildMember->possessionSkills(), $guildMember->studentNumber());
        return $guildMemberModel->save();
    }

    public function all(): array
    {
        $guildMemberModels = $this->eloquent->all();

        $guildMemberCollection =  $guildMemberModels->map(function(GuildMemberEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $guildMemberCollection->toArray();
    }

    public function delete(GuildMember $guildMember): bool
    {
        $guildMemberModel = $this->eloquent->fromEntity($guildMember);
        return $guildMemberModel->delete();
    }

    public function findByLoginInfo(LoginInfo $loginInfo): ?GuildMember
    {
        $email = $loginInfo->address()->address();
        $guildMemberModel = $this->eloquent->where('email', $email)->first();

        if(!$guildMemberModel instanceof GuildMemberEloquent) return null;
        return $guildMemberModel->toEntity();
    }

    public function findByMailAddress(MailAddress $mailAddress): ?GuildMember
    {
        $email = $mailAddress->address();
        $guildMemberModel = $this->eloquent->where('email', $email)->first();

        if(!$guildMemberModel instanceof GuildMemberEloquent) return null;
        return $guildMemberModel->toEntity();
    }
}
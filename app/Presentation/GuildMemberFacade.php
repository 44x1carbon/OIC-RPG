<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/17
 * Time: 17:53
 */

namespace App\Presentation;


use App\ApplicationService\GuildMemberAppService;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Infrastracture\AuthData\AuthData;

class GuildMemberFacade
{
    public function __construct()
    {
    }

    public static function registerMember(
        string $studentNumberData,
        string $studentName,
        string $courseId,
        string $genderId,
        string $mailAddressData,
        string $password,
        array $possessionSkillDatas
    ): AuthData
    {
        $courseRepository = app(CourseRepositoryInterface::class);
        /* @var GuildMemberAppService $guildMemberAppService*/
        $guildMemberAppService = app(GuildMemberAppService::class);
        /* @var PossessionSkillFactory $possessionSkillFactory */
        $possessionSkillFactory = app(PossessionSkillFactory::class);

        $studentNumber = new StudentNumber($studentNumberData);
        $course = $courseRepository->findById($courseId);
        $gender = new Gender($genderId);
        $mailAddress = new MailAddress($mailAddressData);

        $possessionSkillList = [];
        foreach ($possessionSkillDatas as $possessionSkillData){
            // TODO FacadeにPossessionSkillsの中身が連想配列ではなくDTOになった場合は変更する
            $possessionSkillList[] = $possessionSkillFactory->createPossessionSkill(
                                        $possessionSkillData['skillId'],
                                        new StudentNumber($possessionSkillData['studentNumber'])
                                    );
        }

        $possessionSkills = new PossessionSkillCollection($possessionSkillList);
        $loginInfo = new LoginInfo($mailAddress, new Password($password));

        $authData = $guildMemberAppService->registerMember($studentNumber, $studentName , $course, $gender, $mailAddress, $possessionSkills, $loginInfo);

        return $authData;

    }
}
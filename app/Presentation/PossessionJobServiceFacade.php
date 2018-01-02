<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 7:00
 */

namespace App\Presentation;


use App\ApplicationService\PossessionJobAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\ValueObjects\JobId;

class PossessionJobServiceFacade
{
    private $possessionJobAppService;

    public function __construct()
    {
        $this->possessionJobAppService = app(PossessionJobAppService::class);
    }

    public function getJob(string $studentNumber, string $jobId): string
    {
        /* @var JobId $possessionJobId */
        $possessionJobId = $this->possessionJobAppService->getJob(new StudentNumber($studentNumber), new JobId($jobId));
        return $possessionJobId->code();
    }
}
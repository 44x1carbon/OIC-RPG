<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 5:50
 */

namespace App\Eloquents;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use Illuminate\Database\Eloquent\Model;

class PossessionJobEloquent extends Model
{
    protected $table = 'possession_jobs';

    public static function findByStudentNumber(StudentNumber $studentNumber): ?array
    {
        $possessionJobModels = self::where('student_number', $studentNumber->code())->get();
        $possessionJobCollection = $possessionJobModels->map(function(PossessionJobEloquent $eloquent){
            return $eloquent->toEntity();
        });
        return $possessionJobCollection->toArray();
    }

    public static function findBySkillAndStudentNumber(string $jobId, StudentNumber $studentNumber): ?PossessionJobEloquent
    {
        $possessionJobModel = self::where('job_id', $jobId)->where('student_number', $studentNumber->code())->first();
        return $possessionJobModel;
    }

    public static function fromEntity(PossessionJob $possessionJob, StudentNumber $studentNumber): PossessionJobEloquent
    {
        $possessionJobModel = self::findBySkillAndStudentNumber($possessionJob->jobId()->code(), $studentNumber);
        if(is_null($possessionJobModel)) $possessionJobModel = new PossessionJobEloquent();

        $possessionJobModel->student_number = $studentNumber->code();
        $possessionJobModel->job_id = $possessionJob->JobId()->code();

        return $possessionJobModel;
    }

    public function toEntity(): PossessionJob
    {
        $studentNumber = new StudentNumber($this->student_number);
        $jobId = new JobId($this->job_id);

        $entity = new PossessionJob(
            $studentNumber,
            $jobId
        );

        return $entity;
    }

    public static function saveManyDomainObject(PossessionJobCollection $possessionJobCollection, StudentNumber $studentNumber)
    {
        foreach ((array)$possessionJobCollection as $possessionJob)
        {
            $possessionJobModel = self::fromEntity($possessionJob, $studentNumber);
            if(!$possessionJobModel->save()) return false;
        }
        return true;
    }
}
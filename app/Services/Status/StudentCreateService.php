<?php

namespace App\Services\Status;

use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\Entity\StudentSkill;
use App\Domain\Status\Repository\StudentRepository;
use App\Domain\Status\Repository\StudentSkillRepository;
use App\Domain\Status\ValueObject\LevelUpPermit;
use App\Domain\Status\ValueObject\SkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;
use App\Domain\Status\ValueObject\StudentSkillInfo;
use App\Events\AddExpEvent;
use App\Utilities\SkillExpDictionary;

class StudentCreateService
{
    protected $repo;
    protected $studentSkillRepo;

    function __construct(StudentRepository $repo, StudentSkillRepository $studentSkillRepo)
    {
        $this->repo = $repo;
        $this->studentSkillRepo = $studentSkillRepo;
    }

    function create(StudentInfo $studentInfo, Course $course):Student
    {
        return $this->repo->create($studentInfo, $course);
    }

    function addSkill(Student $student, SkillInfo $skillInfo):SkillInfo
    {
        return $this->repo->addSkill($student, $skillInfo);
    }

    function addExp(StudentSkill $studentSkill, int $exp):StudentSkill
    {
        $originInfo = $studentSkill->info();

        $data = $originInfo->toArray();
        $data['exp'] += $exp;
        $newInfo = new StudentSkillInfo($data);
        $updatedStudentSkill = $this->studentSkillRepo->update($studentSkill, $newInfo);
        event(new AddExpEvent($updatedStudentSkill));
        return $updatedStudentSkill;
    }

    function findStudentSkill(Student $student, SkillInfo $skillInfo):StudentSkill
    {
        return $this->repo->findStudentSkill($student, $skillInfo);
    }

    function levelUpSkill(LevelUpPermit $permit):StudentSkill
    {
        $studentSkill = $permit->studentSkill;
        $originInfo = $studentSkill->info();
        $cost = $originInfo->nextExp;

        $data = $originInfo->toArray();
        $data['exp'] -= $cost;
        $data['level'] += 1;
        $data['nextExp'] = SkillExpDictionary::getNeedExp($data['level']);
        $newInfo = new StudentSkillInfo($data);
        $updatedStudentSkill = $this->studentSkillRepo->update($studentSkill, $newInfo);
        return $updatedStudentSkill;
    }

    function addJob(Student $student, Job $job):Job
    {
        //ToDo 適切な例外クラスを作る
        if(!$student->isGettableJob($job)) throw new \Exception("取得条件を満たしていません。");
        return $this->repo->addJob($student, $job);
    }
}
<?php

namespace App\Domain\GuildMember;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\Spec\SearchSpec;
use App\Domain\GuildMember\ValueObjects\SearchCriteria;

class SearchService {
    private $repository;

    function __construct(GuildMemberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(SearchCriteria $criteria): array
    {
        $allGuildMember = $this->repository->all();
        $filteredMember = array_where($allGuildMember, function(GuildMember $guildMember) use ($criteria) {
           return is_all([
               $this->isMatchSkill($guildMember, $criteria),
               $this->isMatchJob($guildMember, $criteria),
               $this->isMatchStudentNumber($guildMember, $criteria)
           ]);
        });

        return $filteredMember;
    }

    private function isMatchSkill(GuildMember $guildMember, SearchCriteria $criteria): bool
    {
        $requests = $criteria->requestSkills;
        if(count($requests) === 0) return true;

        return is_all(array_map(function($requestSkill) use ($guildMember) {
            return SearchSpec::isHigherLevel($guildMember, $requestSkill->skillId, $requestSkill->requireLevel);
        }, $requests));
    }

    private function isMatchJob(GuildMember $guildMember, SearchCriteria $criteria): bool
    {
        $requests = $criteria->requestJobIds;
        if(count($requests) === 0) return true;

        return is_any(array_map(function($requestJob) use ($guildMember) {

            return SearchSpec::ableToJob($guildMember, $requestJob);
        }, $requests));
    }

    private function isMatchStudentNumber(GuildMember $guildMember, SearchCriteria $criteria): bool
    {
        $requests = $criteria->requestStudentNumbers;
        if(count($requests) === 0) return true;

        return is_any(array_map(function($requestStudentNumber) use ($guildMember) {
            return SearchSpec::isMatchStudentNumber($guildMember, $requestStudentNumber);
        }, $requests));
    }
}
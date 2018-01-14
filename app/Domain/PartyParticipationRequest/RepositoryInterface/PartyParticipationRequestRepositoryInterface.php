<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/22
 * Time: 12:00
 */

namespace App\Domain\PartyParticipationRequest\RepositoryInterface;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;

interface PartyParticipationRequestRepositoryInterface
{
    public function findById(string $id): ?PartyParticipationRequest;

    public function findListByStudentNumber(StudentNumber $studentNumber): array;

    public function findListByPartyId(string $partyId): array;

    public function findByPartyIdAndWantedRoleId(string $partyId, string $wantedRoleId): ?PartyParticipationRequest;

    public function findByPartyIdAndStudentNumber(string $partyId, StudentNumber $studentNumber): ?PartyParticipationRequest;

    public function save(PartyParticipationRequest $party): bool;

    public function all(): array;

    public function nextId(): string;

    public function delete(PartyParticipationRequest $partyParticipationRequest): bool;
}
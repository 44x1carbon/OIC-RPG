<?php

namespace App\Domain\Scout;

use App\Domain\GuildMember\ValueObjects\StudentNumber;

interface ScoutRepositoryInterface
{
    public function nextId(): string;

    public function save(Scout $scout): bool;

    public function findById(string $id): ?Scout;

    public function findByTo(StudentNumber $to): array;

    public function findByFrom(StudentNumber $from): array;

    public function findByPartyId(string $partyId): array;
}
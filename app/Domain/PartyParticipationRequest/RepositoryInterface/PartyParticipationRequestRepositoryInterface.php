<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/22
 * Time: 12:00
 */

namespace App\Domain\PartyParticipationRequest\RepositoryInterface;

use App\Domain\PartyParticipationRequest\PartyParticipationRequest;

interface PartyParticipationRequestRepositoryInterface
{
    public function findById(String $id): ?PartyParticipationRequest;

    public function save(PartyParticipationRequest $party): bool;

    public function all(): array;

    public function nextId(): string;
}
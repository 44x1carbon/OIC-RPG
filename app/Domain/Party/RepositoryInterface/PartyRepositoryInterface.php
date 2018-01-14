<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 17:26
 */

namespace App\Domain\Party\RepositoryInterface;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;

interface PartyRepositoryInterface
{
    public function findById(String $id): ?Party;

    public function findListByManagerId(StudentNumber $managerId): ?array;

    public function findListByOfficerId(StudentNumber $officerId): ?array;

    public function save(Party $party): bool;

    public function all(): array;

    public function nextId(): string;
}
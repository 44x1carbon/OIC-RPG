<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/15
 * Time: 15:57
 */

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;

class PartyMemberAppService
{
    protected $factory;
    /* @var PartyRepositoryInterface $partyRepository  */
    protected $partyRepository;

    function __construct(PartyRepositoryInterface $partyRepository)
    {
        $this->partyRepository = $partyRepository;
    }

    public function assignPartyMember(string $partyId, string $wantedRoleId, StudentNumber $partyManagerId, StudentNumber $guildMemberId)
    {
        $party = $this->partyRepository->findById($partyId);

        if (!$party->partyManagerId()->equals($partyManagerId)) throw new \Exception('[ApplicationService] Party Member Permission Assign Error');

        $party->assignMember($wantedRoleId, $guildMemberId);
        $this->partyRepository->save($party);

        return $guildMemberId;
    }
}
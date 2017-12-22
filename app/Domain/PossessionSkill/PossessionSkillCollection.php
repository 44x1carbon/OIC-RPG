<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/15
 * Time: 12:31
 */

namespace App\Domain\PossessionSkill;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Skill;
use ArrayObject;
use InvalidArgumentException;

class PossessionSkillCollection extends ArrayObject
{
    public function __construct(array $possessionSkills)
    {
        foreach ($possessionSkills as $possessionSkill)
        {
            $this->append($possessionSkill);
        }
    }

    function append($value)
    {
        if($value instanceof PossessionSkill)
        {
            return parent::append($value);
        }
        throw new InvalidArgumentException;
    }

    public function findPossessionSkill(string $skillId): ?PossessionSkill
    {
        $result = array_filter((array) $this, function(PossessionSkill $possessionSkill) use($skillId){
            return $possessionSkill->skillId() === $skillId;
        });
        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function getOffset($skillId): int
    {
        $result = 0;
        /* @var PossessionSkill $possessionSkill*/
        for($i = 0; $i < $this->count(); $i++)
        {
            $possessionSkill = $this->offsetGet($i);
            if($possessionSkill->skillId() === $skillId)
            {
                $result = $i;
                break;
            }
        }
        return $result;
    }
}
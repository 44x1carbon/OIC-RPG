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

    public function findPossessionSkill(string $skillId, StudentNumber $studentNumber): PossessionSkill
    {
        $result = array_filter((array) $this, function(PossessionSkill $possessionSkill) use($skillId, $studentNumber){
            return $possessionSkill->skillId() === $skillId && $possessionSkill->studentNumber()->code() === $studentNumber->code();
        });
        if(count($result) > 0) {
            $possessionSkill = $result[0];
        } else {
            $possessionSkill = null;
        }

        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->createPossessionSkill($skillId, $studentNumber);
        }

        return $possessionSkill;
    }
}
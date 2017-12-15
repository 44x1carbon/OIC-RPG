<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/15
 * Time: 12:31
 */

namespace App\Domain\PossessionSkill;


use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use ArrayObject;
use InvalidArgumentException;

class PossessionSkillCollection extends ArrayObject
{
    protected $possessionSkillRepo;

    public function __construct()
    {
        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
    }

    function offsetSet($offset, $value)
    {
        if($value instanceof PossessionSkill)
        {
            return parent::offsetSet($offset, $value);
        }
        throw new InvalidArgumentException;
    }

    public function findPossessionSkill($skill, $studentNumber): PossessionSkill
    {
        $possessionSkill = $this->possessionSkillRepo->findBySkillAndStudentNumber($skill, $studentNumber);

        if(is_null($possessionSkill))
        {
            $possessSkillFactory = new PossessionSkillFactory();
            $possessionSkill = $possessSkillFactory->createPossessionSkill($skill, $studentNumber);
        }

        return $possessionSkill;
    }
}
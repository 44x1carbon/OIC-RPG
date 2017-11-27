<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/24
 * Time: 15:55
 */

namespace App\Eloquents;


use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\Skill;
use Illuminate\Database\Eloquent\Model;

class SkillEloquent extends Model
{
    protected $table = 'skill';

    /* @var SkillFactory $factory */
    protected $factory;

    public function __construct()
    {
        $this->factory = app(SkillFactory::class);
    }

    public function toEntity(): Skill
    {
        $entity = new Skill();

        $entity->setSkillId($this->skillId());
        $entity->setSkillName($this->skillName());

        return $entity;
    }

    public function findBySkillId(string $id): ?SkillEloquent
    {
        return $this->where('skill_id', $id)->first();
    }

    public function skillId(): string
    {
        return $this->skill_id;
    }

    public function skillName(): string
    {
        return $this->name;
    }
}
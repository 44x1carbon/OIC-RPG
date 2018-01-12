<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/01/03
 * Time: 0:42
 */

namespace App\Infrastracture\GuildMember;


use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\MemberSkillStatus;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Infrastracture\Field\FieldViewModel;
use App\Infrastracture\Job\SkillViewModel;
use App\Infrastracture\PossessionSkill\PossessionSkillViewModel;

/**
 * Class MemberSkillStatusViewModel
 * @package App\Infrastracture\GuildMember
 */
class MemberSkillStatusViewModel
{
    private $memberSkillStatus;
    private $skill = null;
    private $field = null;
    /* @var PossessionSkillViewModel $possessionSkill */
    public $possessionSkill;

    /* @var SkillRepositoryInterface $skillRepo */
    private $skillRepo;
    /* @var FieldRepositoryInterface $fieldRepo */
    private $fieldRepo;

    /**
     * MemberSkillStatusViewModel constructor.
     * @param MemberSkillStatus $status
     */
    public function __construct(MemberSkillStatus $status)
    {
        $this->memberSkillStatus = $status;
        $this->skillAcquisitionStatus = new SkillAcquisitionStatusViewModel($status->status());
        $this->possessionSkill = null_safety($status->possessionSkill(), function(PossessionSkill $possessionSkill) {
            return new PossessionSkillViewModel($possessionSkill);
        });
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->fieldRepo = app(FieldRepositoryInterface::class);
    }

    /**
     * @return SkillViewModel
     */
    public function skill(): SkillViewModel
    {
        if(is_null($this->skill)) {
            $skill = $this->skillRepo->findBySkillId($this->memberSkillStatus->skillId());
            $this->skill = new SkillViewModel($skill);
        }

        return $this->skill;
    }

    /**
     * @return FieldViewModel
     */
    public function field(): FieldViewModel
    {
        if(is_null($this->field)) {
            $skillId  = $this->memberSkillStatus->skillId();
            $field = $this->fieldRepo->findBySkillId($skillId);
            $this->field = new FieldViewModel($field);
        }

        return $this->field;
    }
}
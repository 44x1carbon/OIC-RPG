<?php

namespace App\Http\Requests;

use App\Domain\GuildMember\ValueObjects\SearchCriteria;
use App\Domain\Job\ValueObjects\JobId;
use Illuminate\Foundation\Http\FormRequest;

class GuildMemberSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function requestJobId(): ?JobId
    {
        $request_job_id = $this->get('request_job_id');
        if(is_null($request_job_id)) return null;
        return new JobId($request_job_id);
    }

    public function requestSkills(): array
    {
        $request_skills = $this->input('request_skills');
        if(is_null($request_skills)) return [];
        return collect($request_skills)
            ->filter(function ($request_skill) {
                return $request_skill['skill_id'] !== null || $request_skill['require_level'] !== null;
            })
            ->toArray();
    }

    public function searchCriteria(): SearchCriteria
    {
        $criteria = new SearchCriteria();
        if($this->requestJobId() != null) {
            $criteria->addRequestJobId($this->requestJobId());
        }

        if($this->requestSkills() != []) {
            foreach ($this->requestSkills() as $requestSkill) {
                $criteria->addRequestSkill($requestSkill['skill_id'], $requestSkill['require_level']);
            }
        }
        return $criteria;
    }
}

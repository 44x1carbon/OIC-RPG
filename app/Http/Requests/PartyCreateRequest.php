<?php

namespace App\Http\Requests;

use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Domain\WantedMember\ValueObjects\WantedRole;
use App\Presentation\DTO\WantedRoleDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PartyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // develop
        return true;

        //production
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'party.activityEndDate' => ['required'],
            'party.productionIdea.productionTheme' => ['required'],
            'party.productionIdea.productionTypeId'  => ['required'],
            'party.productionIdea.ideaDescription' => ['required'],
            'party.wantedRoleList'    => ['required', 'array'],
            'party.wantedRoleList.*.frameAmount' => ['required'],
            'party.wantedRoleList.*.remarks' => [],
            'party.wantedRoleList.*.roleName' => ['required'],
            'party.wantedRoleList.*.referenceJobId' => [],
        ];
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function($validator){
            // Call the after method of the FormRequest (see below)
            $this->after($validator);
        });
    }

    public function after($validator)
    {
        Log::debug($validator->errors());
    }

    private function party(): array
    {
        return $this->request->get('party');
    }

    public function roleName(): string
    {
        return $this->party()['roleName'];
    }

    public function activityEndDate(): \DateTime
    {
        $dateStr = $this->party()['activityEndDate'];
        return \DateTime::createFromFormat('Y-m-d', $dateStr);
    }

    public function productionTheme(): string
    {
        return $productionIdeaData = $this->party()['productionIdea']['productionTheme'];
    }

    public function productionTypeId(): string
    {
        return $productionIdeaData = $this->party()['productionIdea']['productionTypeId'];
    }

    public function ideDescription(): string
    {
        return $productionIdeaData = $this->party()['productionIdea']['ideaDescription'];
    }

    public function wantedRoleList(): array
    {
        return array_map(function($wantedRole) {
            return new WantedRoleDto($wantedRole['roleName'], $wantedRole['remarks'], $wantedRole['referenceJobId'], $wantedRole['frameAmount']);
        }, $this->party()['wantedRoleList']);
    }
}

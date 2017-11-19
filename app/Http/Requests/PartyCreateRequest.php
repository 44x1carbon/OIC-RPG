<?php

namespace App\Http\Requests;

use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\ValueObject\ProductionIdeaInfo;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionType\ProductionType;
use App\Domain\WantedMember\Factory\WantedMemberFactory;
use App\Domain\WantedMember\ValueObjects\WantedRole;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
            'party.productionIdea.productionType'  => ['required'],
            'party.productionIdea.ideaDescription' => ['required'],
            'party.wantedRoleList'    => ['required', 'array'],
            'party.wantedRoleList.*.frameAmount' => ['required'],
            'party.wantedRoleList.*.remarks' => ['required'],
            'party.wantedRoleList.*.name' => ['required'],
            'party.wantedRoleList.*.referenceJobId' => ['required'],
        ];
    }

    private function party(): array
    {
        return $this->request->get('party');
    }

    public function activityEndDate(): ActivityEndDate
    {
        $dateStr = $this->party()['activityEndDate'];
        $date = \DateTime::createFromFormat('Y-m-d', $dateStr);
        return new ActivityEndDate($date->getTimestamp());
    }

    public function productionIdeaInfo(): ProductionIdeaInfo
    {
        $productionIdeaData = $this->party()['productionIdea'];
        $productionType = new ProductionType($productionIdeaData['productionType']);
        return new ProductionIdeaInfo($productionIdeaData['productionTheme'], $productionType, $productionIdeaData['ideaDescription']);
    }

    public function wantedRoleList(): array
    {
        return array_map(function($wantedRole) {
            return new WantedRoleInfo($wantedRole['name'], $wantedRole['remarks'], $wantedRole['referenceJobId'], $wantedRole['frameAmount']);
        }, $this->party()['wantedRoleList']);
    }
}

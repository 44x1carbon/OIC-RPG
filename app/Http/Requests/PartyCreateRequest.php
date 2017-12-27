<?php

namespace App\Http\Requests;

use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\WantedMember\ValueObjects\WantedRole;
use App\Presentation\DTO\PartyDto;
use App\Presentation\DTO\ProductionIdeaDto;
use App\Presentation\DTO\ProductionTypeDto;
use App\Presentation\DTO\WantedRoleDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PartyCreateRequest extends FormRequest
{

    protected $productionTypeRepository;

    public function __construct(
        array $query = array(),
        array $request = array(),
        array $attributes = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->productionTypeRepository = app(ProductionTypeRepositoryInterface::class);
    }

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

    public function productionIdeaDto(): ProductionIdeaDto
    {
        $productionIdea = $this->input('party.productionIdea');
        return new ProductionIdeaDto(
            $productionIdea['productionTheme'],
            $this->productionTypeDto(),
            $productionIdea['ideaDescription']
        );
    }

    public function productionTypeDto(): ProductionTypeDto
    {
        $productionTypeId = $this->input('party.productionIdea.productionTypeId');

        /* @var ProductionType $productionType */
        $productionType = $this->productionTypeRepository->findById($productionTypeId);
        return new ProductionTypeDto(
            $productionType->id(),
            $productionType->name()
        );
    }

    public function activityEndDate(): string
    {
        return $this->input('party.activityEndDate');
    }

    public function wantedRoleDtos(): array
    {
        return array_map(function($w) {
            return new WantedRoleDto(
                $w['roleName'],
                $w['remarks'],
                $w['referenceJobId'],
                $w['frameAmount'],
                isset($w['managerAssigned'])? w['managerAssigned'] : false
            );
        }, $this->input('party.wantedRoleList'));
    }

    public function partyDto(): PartyDto
    {
        return new PartyDto(
            $this->activityEndDate(),
            $this->productionIdeaDto(),
            $this->wantedRoleDtos()
        );
    }
}

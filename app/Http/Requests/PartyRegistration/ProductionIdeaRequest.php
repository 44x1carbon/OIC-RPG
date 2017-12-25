<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 11:52
 */

namespace App\Http\Requests\PartyRegistration;

use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Presentation\DTO\ProductionIdeaDto;
use App\Presentation\DTO\ProductionTypeDto;
use Illuminate\Foundation\Http\FormRequest;

class ProductionIdeaRequest extends FormRequest
{
    /* @var ProductionTypeRepositoryInterface $productionTypeRepository */
    private $productionTypeRepository;

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

    public function rules()
    {
        return [
            'party.activityEndDate' => ['required'],
            'party.productionIdea.productionTheme' => ['required'],
            'party.productionIdea.productionTypeId'  => ['required'],
            'party.productionIdea.ideaDescription' => ['required'],
        ];
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
}
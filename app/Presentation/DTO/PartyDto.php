<?php

namespace App\Presentation\DTO;

class PartyDto
{
    public $activityEndDate;
    public $productionIdeaDto;
    public $wantedRoleDtos;

    function __construct(string $activityEndDate = null, ProductionIdeaDto $productionIdeaDto = null, array $wantedRoleDtos = null)
    {
        $this->activityEndDate = $activityEndDate;
        $this->productionIdeaDto = $productionIdeaDto;
        $this->wantedRoleDtos = $wantedRoleDtos ?? [new WantedRoleDto()];
    }

    /**
     * @return string
     */
    public function activityEndDate(): ?string
    {
        return $this->activityEndDate;
    }

    /**
     * @param string $activityEndDate
     */
    public function setActivityEndDate(string $activityEndDate)
    {
        $this->activityEndDate = $activityEndDate;
    }

    /**
     * @return ProductionIdeaDto
     */
    public function productionIdeaDto(): ?ProductionIdeaDto
    {
        return $this->productionIdeaDto;
    }

    /**
     * @param ProductionIdeaDto $productionIdeaDto
     */
    public function setProductionIdeaDto(ProductionIdeaDto $productionIdeaDto)
    {
        $this->productionIdeaDto = $productionIdeaDto;
    }

    /**
     * @return array
     */
    public function wantedRoleDtos(): ?array
    {
        return $this->wantedRoleDtos;
    }

    /**
     * @param array $wantedRoleDtos
     */
    public function setWantedRoleDtos(array $wantedRoleDtos)
    {
        $this->wantedRoleDtos = $wantedRoleDtos;
    }
}
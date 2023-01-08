<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     
        return [
            'id' => $this->id,
            'project_title' => $this->title,
            'project_state' => new StateResource($this->state),
            'project_lga' => new LgaResource($this->lga),
            'project_year' => $this->year,
            'project_contractor' => new ContractorResource($this->contractor),
            'project_contract_amount' => $this->contract_amount,
            'project_budget_amount' => $this->budget_amount,
            'project_mda' => new MdaResource($this->mda),   
            'project_sector' => new SectorResource($this->sector),        
        ];
    }
}

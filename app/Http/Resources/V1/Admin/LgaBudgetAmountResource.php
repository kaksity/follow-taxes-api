<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LgaBudgetAmountResource extends JsonResource
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
            'lga' => new LgaResource($this->lga),
            'budget_item' => new BudgetItemResource($this->budgetItem),
            'year' => $this->year,
            'proposed_amount'=>$this->proposed_amount,
            'approved_amount'=>$this->approved_amount,
            'revised_amount'=>$this->revised_amount,
            'actual_amount'=>$this->actual_amount,
        ];
    }
}

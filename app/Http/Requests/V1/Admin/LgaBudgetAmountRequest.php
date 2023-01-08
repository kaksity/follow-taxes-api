<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LgaBudgetAmountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        if($this->getMethod() == 'GET')
        {
            $rules += [
                'lga_id' => ['uuid','nullable'],
                'budget_item_id' => ['uuid', 'nullable']
            ];
        }
        if($this->getMethod() == 'POST')
        {
            $rules += [
                'lga_id' => ['required', 'uuid'],
                'budget_item_id' => ['required', 'uuid'],
                'proposed_amount' => ['required', 'string'],
                'approved_amount' => ['required', 'string'],
                'revised_amount' => ['required', 'string'],
                'actual_amount' => ['required', 'string'],
                'year' => ['required', 'string']
            ];
        }
        return $rules;
    }
}

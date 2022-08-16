<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
                'per_page' => ['integer', 'max: 100', 'min: 0']
            ];
        }
        else if ($this->getMethod() == 'POST')
        {
            $rules += [
                'title' => ['required', 'min:3'],
                'state_id' => ['required', 'uuid'],
                'lga_id' => ['required', 'uuid'],
                'year' => ['required', 'integer'],
                'contractor_id' => ['required', 'uuid'],
                'budget_amount' => ['required', 'numeric'],
                'contract_amount' => ['required', 'numeric'],
                'mda_id' => ['required', 'uuid']
            ];
        }
        else if ($this->getMethod() == 'PUT')
        {
            $rules += [
                'title' => ['required', 'min:3'],
                'state_id' => ['required', 'uuid'],
                'lga_id' => ['required', 'uuid'],
                'year' => ['required', 'integer'],
                'contractor_id' => ['required', 'uuid'],
                'budget_amount' => ['required', 'numeric'],
                'contract_amount' => ['required', 'numeric'],
                'mda_id' => ['required', 'uuid']
            ];
        }
        return $rules;
    }
}

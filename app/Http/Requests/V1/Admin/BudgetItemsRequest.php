<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BudgetItemsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        if($this->getMethod() == 'POST')
        {
            $rules += [
                'name' => ['required', 'string'],
                'type' => ['required', 'string', 'in:receipt,expenditure']
            ];
        }
        return $rules;
    }
}

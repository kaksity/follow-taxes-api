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
        if($this->getMethod() == 'POST')
        {
            $rules += [
                'lga_id' => ['required', 'uuid'],
                'amount' => ['required', 'numeric'],
                'year' => ['required', 'integer']
            ];
        }
        return $rules;
    }
}

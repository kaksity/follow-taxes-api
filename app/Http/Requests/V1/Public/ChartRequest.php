<?php

namespace App\Http\Requests\V1\Public;

use Illuminate\Foundation\Http\FormRequest;

class ChartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        
        if($this->getMethod() == 'GET') {
            $rules += [
                'sector' => ['required','string']
            ];
        }

        return $rules;
    }
}

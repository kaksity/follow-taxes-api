<?php

namespace App\Http\Requests\V1\Public;

use Illuminate\Foundation\Http\FormRequest;

class ContractorRequest extends FormRequest
{
    public function rules()
    {
        $rules =  [];
        if($this->getMethod() == 'GET')
        {
            $rules += [

            ];
        }
        else if ($this->getMethod() == 'POST')
        {
            $rules += [
                'contractor_name' => ['required', 'min:3']
            ];
        }
        return $rules;
    }
}

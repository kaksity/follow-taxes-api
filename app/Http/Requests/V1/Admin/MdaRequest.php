<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MdaRequest extends FormRequest
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
                'mda_name' => ['required', 'min:3']
            ];
        }
        return $rules;
    }
}

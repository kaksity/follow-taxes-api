<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
                'state_name' => ['required', 'min:3']
            ];
        }
        return $rules;
    }
}

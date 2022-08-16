<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LgaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =  [];
        if($this->getMethod() == 'GET')
        {
            $rules += [
                'state_id' => ['uuid']
            ];
        }
        else if ($this->getMethod() == 'POST')
        {
            $rules += [
                'state_id' => ['required', 'uuid'],
                'lga_name' => ['required', 'min:3']
            ];
        }
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'min:6',
            'email'                 => 'email',
            'role'                  => 'numeric|gt:0',
            'employement_status'    => 'numeric|gt:0',
            'date_of_birth'         => 'date_format:Y-m-d'
        ];
    }
}

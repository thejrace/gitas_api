<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormUpdateRequest extends FormRequest
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
        $ignoreID = $this->get('id');
        return [
            'name'                  => 'min:20',
            'email'                 => [ 'email',  Rule::unique('users')->ignore($ignoreID) ],
            'password'              => 'required',
            'date_of_birth'         => 'date_format:Y-m-d'

        ];
    }
}

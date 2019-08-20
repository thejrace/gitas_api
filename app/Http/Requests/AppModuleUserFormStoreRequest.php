<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppModuleUserFormStoreRequest extends FormRequest
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
            'app_module_id'         => 'required',
            'name'                  => 'required|min:3',
            'email'                 => 'required|email|unique:app_module_users',
            'password'              => 'required'
        ];
    }
}

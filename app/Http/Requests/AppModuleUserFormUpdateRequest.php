<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppModuleUserFormUpdateRequest extends FormRequest
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
        $ignoreID = $this->route('app_module_user')->id;

        return [
            'name'          => 'filled|min:3',
            'email'         => ['filled', 'email', Rule::unique('app_module_users')->ignore($ignoreID)],
            'password'      => 'nullable',
            'date_of_birth' => 'date_format:Y-m-d',
        ];
    }
}

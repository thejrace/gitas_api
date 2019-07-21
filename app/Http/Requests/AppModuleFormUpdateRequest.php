<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppModuleFormUpdateRequest extends FormRequest
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
        $ignoreID = $this->route('app_module')->id;
        return [
            'name' => [ 'required', Rule::unique('app_modules')->ignore($ignoreID) ],
            'permission_prefix' => [ 'required', Rule::unique('app_modules')->ignore($ignoreID) ]
        ];
    }
}

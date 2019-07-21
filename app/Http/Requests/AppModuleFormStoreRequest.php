<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppModuleFormStoreRequest extends FormRequest
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
            'name'              => 'required|unique:app_modules',
            'permission_prefix' => 'required|unique:app_modules'
        ];
    }
}

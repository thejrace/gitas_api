<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppModulePermissionStoreFormRequest extends FormRequest
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
        $appModuleID = $this->get('app_module_id');
        return [
            'app_module_id'             => 'required|numeric',
            'name'                      => [ 'required', Rule::unique('app_module_permissions')->where('app_module_id', $appModuleID) ],
            'value_type'                => 'required|numeric',
            'default_value'             => 'required'
        ];
    }
}

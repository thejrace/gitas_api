<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppModulePermissionUpdateFormRequest extends FormRequest
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
            'name'                      => [ 'filled', Rule::unique('app_module_permissions')->where('app_module_id', $appModuleID) ],
            'value_type'                => 'filled|numeric'
        ];
    }
}

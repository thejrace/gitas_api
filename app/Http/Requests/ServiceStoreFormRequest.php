<?php

namespace App\Http\Requests;

use App\Enums\ServiceStatus;
use App\Enums\ServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceStoreFormRequest extends FormRequest
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
        $ignoreId = $this->route('id');

        return [
            'name' => [
                'required',
                Rule::unique('services', 'name')->ignore($ignoreId),
            ],
            'type' => [
                'required',
                Rule::in(ServiceType::getValues()),
            ],
            'status' => [
                'required',
                Rule::in(ServiceStatus::getValues()),
            ],
            'interval' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
}

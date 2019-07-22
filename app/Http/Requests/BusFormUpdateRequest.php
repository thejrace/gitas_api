<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusFormUpdateRequest extends FormRequest
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
        $ignoreID = $this->route('bus')->id;
        return [
            'code'                      => [ 'required', Rule::unique('buses')->ignore($ignoreID) ],
            'active_plate'              => [ 'required', Rule::unique('buses')->ignore($ignoreID) ],
            'official_plate'            => [ 'required', Rule::unique('buses')->ignore($ignoreID) ]
        ];
    }
}

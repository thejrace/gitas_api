<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusPlateFormRequest extends FormRequest
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
            /*'active_plate'   => ['required', Rule::unique('buses')->ignore($ignoreID)],
            'official_plate' => ['required', Rule::unique('buses')->ignore($ignoreID)],*/
        ];
    }
}

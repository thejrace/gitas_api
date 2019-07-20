<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'active_plate'              => 'required|min:5|max:20',
            'official_plate'            => 'required|min:5|max:20',
            'define_to_user_default'    => 'numeric'
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Map;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'owner_fname' => 'required|max:25|min:2',
            'owner_lname' => 'required|max:25|min:2',
            'owner_nationalcode' => 'required|digits:10',
            'postal_code' => 'required|numeric|digits:10',
            'point' => 'required',
            'property_type_id' => 'required|exists:property_types,id',
            'usage_type_id' => 'required|exists:usage_types,id'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest
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
            'name' => 'required|max:255|exists:bike_models'            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please select bike model name',
            'name.exists' => 'Selected model name does not exists',
        ];
    }
}

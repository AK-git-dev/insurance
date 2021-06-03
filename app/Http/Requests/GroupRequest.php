<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'group_name' => 'required|max:255',
            'no_of_people' => 'required',
            'city' => 'required',
            'group_description' => 'required',
            'group_image' => 'required|mimes:png,jpeg,jpg|max:2048',  
            'profile' => 'required|mimes:png,jpeg,jpg|max:2048'   
        ];
    }
}

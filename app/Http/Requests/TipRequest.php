<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
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
            'file_name' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'file_name.mimes' => 'File type should be mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',
            'file_name.max' => 'File size is too large',
        ];
    }
}

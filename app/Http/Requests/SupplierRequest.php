<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'supplier_category' => 'required',
            'supplier_name' => 'required',
            'supplier_image' => 'mimes:png,jpeg,jpg|max:2048',
            'supplier_address' => 'required',
            'supplier_rating' => 'required',
            'supplier_website' => 'required',
            'supplier_brand' => 'required',
            'supplier_description' => 'required',
        ];
    }
}

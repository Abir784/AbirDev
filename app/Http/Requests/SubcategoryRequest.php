<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
            'subcategory_name'=>'required|unique:subcategories',
        ];
    }
    public function messages()
    {
        return [
            'subcategory_name.required'=>'This field can not be empty',
            'subcategory_name.unique'=>'This Subcategory is being added already ',

        ];
    }
}

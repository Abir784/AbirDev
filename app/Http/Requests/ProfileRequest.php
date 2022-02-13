<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Validated;
class ProfileRequest extends FormRequest
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
            'name'=>'required',
            'profile_image'=>'image',
            'old_password'=>'required',

];
    }

    public function messages()

        {

         return   [
           'name.required'=>'Enter your name',
           'old_password.required'=>'You have to enter password',
           'profile_image.image'=>'You must select an image file only',

            ];
       }
 }


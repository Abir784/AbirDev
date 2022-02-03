<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
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
            'old_password'=>'required',
            'password'=> ['confirmed' ,Password::min(8)
             ->letters()
             ->mixedCase()
             ->numbers()
             ->symbols()
             ],

        ];

    }
    public function messages()

        {

         return   [
           'name.required'=>'Enter your name',
           'old_password.required'=>'You have to enter your old password',
           'password.confirmed'=>'Both passwords didnt match',

            ];
       }
 }


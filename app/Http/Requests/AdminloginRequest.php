<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminloginRequest extends FormRequest
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
            'email'=> 'required|email',
            'password'=>'required'
       ];
    }

    public function messages()
    {
        return[
            'email.required'=>'il faut entrer email',
            'email.email'=>'il faut entrer un email valide',
            'password.required'=>'il faut entrer pass'
        ];
    }

}

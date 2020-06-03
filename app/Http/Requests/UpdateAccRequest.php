<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class UpdateAccRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
          'name' => 'required|min:2|max:70',
          'email' => 'required|email|unique:users,email,'.Session::get('user_id'),
          'password' => 'nullable|min:6|max:20|confirmed',
        ];
    }

    public function messages()
    {
      return [
        'password.confirmed' => 'Password confirmation does not match',
      ];
    }
}

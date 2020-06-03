<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class NewUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        $ignore = !empty($request['item_id']) ? ',' . $request['item_id'] : '';

        return [
            'role' => 'required',
            'status' => 'required',
            'name' => 'required|min:2|max:70',
            'email' => 'required|email|unique:users,email' . $ignore,
            'password' => 'min:6|max:20|required_unless:eval_pw,no|nullable',
        ];
    }

    public function messages()
    {
      return [
        'password.required_unless' => 'The password field is required.',
      ];
    }
}

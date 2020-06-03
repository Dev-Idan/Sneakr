<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
          'name' => 'required|min:2|max:70',
          'email' => 'required|email',
          'subject' => 'required|min:2|max:100',
          'message' => 'required|min:2|max:600',
          'captcha' => 'required|captcha',
        ];
    }

    public function messages()
    {
      return [
        'captcha.captcha' => 'Captcha does not match',
      ];
    }
}

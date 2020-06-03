<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'menu_id' => 'required',
            'ctitle' => 'required|min:2|max:255',
            'carticle' => 'required|min:2'
        ];
    }

    public function messages()
    {
      return [
        'menu_id.required' => 'The menu link field is required.',
        'ctitle.required' => 'The title field is required.',
        'ctitle.min' => 'The title must be at least 2 characters.',
        'ctitle.max' => 'The title may not be greater than 255 characters.',
        'carticle.required' => 'The article field is required.',
        'carticle.min' => 'The article must be at least 2 characters.',
      ];
    }
}

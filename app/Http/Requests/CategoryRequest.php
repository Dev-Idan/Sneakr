<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        $ignore = !empty($request['item_id']) ? ',' . $request['item_id'] : '';

        return [
          'ctitle' => 'required|min:2|max:100',
          'curl' => 'required|min:2|max:100|regex:/^[a-z\d-]+$/|unique:categories,curl' . $ignore,
          'carticle' => 'required|min:2',
          'cimage' => 'image|max:5242880|required_unless:eval_pic,no',
        ];
    }

    public function messages()
    {
      return [
        'ctitle.required' => 'The title field is required.',
        'ctitle.min' => 'The title must be at least 2 characters.',
        'ctitle.max' => 'The title may not be greater than 100 characters.',
        'curl.required' => 'The url field is required.',
        'curl.min' => 'The url must be at least 2 characters.',
        'curl.max' => 'The url may not be greater than 100 characters.',
        'curl.regex' => 'The url format is invalid.',
        'curl.unique' => 'The url has already been taken.',
        'carticle.required' => 'The description field is required.',
        'carticle.min' => 'The description must be at least 2 characters.',
        'cimage.required_unless' => 'An image is required.',
        'cimage.image' => 'The file must be an image! (jpg,jpeg,png,gif)',
        'cimage.max' => 'The image cannot be bigger than 5MB',
      ];
    }
}

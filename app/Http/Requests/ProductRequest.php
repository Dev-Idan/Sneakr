<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        $ignore = !empty($request['item_id']) ? ',' . $request['item_id'] : '';

        return [
          'category_id' => 'required',
          'ptitle' => 'required|min:2|max:255',
          'purl' => 'required|min:2|max:255|regex:/^[a-z\d-]+$/|unique:products,purl' . $ignore,
          'price' => 'required|numeric',
          'brand' => 'required',
          'color' => 'required',
          'particle' => 'required|min:2',
          'pimage' => 'image|max:5242880|required_unless:eval_pic,no',
          'pgallery.*' => 'image|max:5242880',
        ];
    }

    public function messages()
    {
      return [
        'category_id.required' => 'You have to choose a Category for the product.',
        'ptitle.required' => 'The title field is required.',
        'ptitle.min' => 'The title must be at least 2 characters.',
        'ptitle.max' => 'The title may not be greater than 255 characters.',
        'purl.required' => 'The url field is required.',
        'purl.min' => 'The url must be at least 2 characters.',
        'purl.max' => 'The url may not be greater than 255 characters.',
        'purl.regex' => 'The url format is invalid.',
        'purl.unique' => 'The url has already been taken.',
        'particle.required' => 'The description field is required.',
        'particle.min' => 'The description must be at least 2 characters.',
        'pimage.required_unless' => 'A Main image is required.',
        'pimage.image' => 'The file must be an image! (jpg,jpeg,png,gif)',
        'pimage.max' => 'The image cannot be bigger than 5MB',
        'pgallery.*.image' => 'The file must be an image! (jpg,jpeg,png,gif)',
        'pgallery.*.max' => 'The image cannot be bigger than 5MB',
      ];
    }
}

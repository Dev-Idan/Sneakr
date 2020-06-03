<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        $ignore = !empty($request['item_id']) ? ',' . $request['item_id'] : '';
        
        return [
            'link' => 'required|min:2|max:50',
            'url' => 'required|min:2|max:100|regex:/^[a-z\d-]+$/|unique:menus,murl' . $ignore,
            'title' => 'required|min:2|max:100'
        ];
    }
}

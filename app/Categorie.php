<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Image;

class Categorie extends Model
{

  public static function save_new($request)
  {

    if ($request->hasFile('cimage') && $request->file('cimage')->isValid() ) {

      $file = $request->file('cimage');
      $image_name = date('Y.m.d.H.i.s') . '-' . $file->getClientOriginalName();

      $request->file('cimage')->move(public_path() . '/imgs/categories/',$image_name);

      $img = Image::make(public_path() . '/imgs/categories/' . $image_name);
      $img->resize(574,null,function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save();

    }

    $category = new self();
    $category->ctitle = $request['ctitle'];
    $category->curl = $request['curl'];
    $category->carticle = $request['carticle'];
    $category->cimage = $image_name ?? 'noimage.jpg';


    $category->save();

    Session::flash('successM','Category Added Successfuly!');

  }

  public static function update_item($request,$id)
  {

    $image_name = '';

    if ($request->hasFile('cimage') && $request->file('cimage')->isValid() ) {

      $file = $request->file('cimage');
      $image_name = date('Y.m.d.H.i.s') . '-' . $file->getClientOriginalName();

      $request->file('cimage')->move(public_path() . '/imgs/categories/',$image_name);

      $img = Image::make(public_path() . '/imgs/categories/' . $image_name);
      $img->resize(574,null,function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save();

    }

    $category = self::find($id);
    $category->ctitle = $request['ctitle'];
    $category->curl = $request['curl'];
    $category->carticle = $request['carticle'];

    if ($image_name) {
      $category->cimage = $image_name;
    }

    $category->save();

    Session::flash('successM','Content Updated Successfuly!');

  }

}

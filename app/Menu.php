<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Menu extends Model
{
  public static function save_new($request)
  {

    $menu = new self();
    $menu->link = $request['link'];
    $menu->murl = $request['url'];
    $menu->mtitle = $request['title'];

    $menu->save();

    Session::flash('successM','Menu Added Successfuly!');

  }

  public static function update_item($request,$id)
  {

    $menu = self::find($id);
    $menu->link = $request['link'];
    $menu->murl = $request['url'];
    $menu->mtitle = $request['title'];

    $menu->save();

    Session::flash('successM','Menu Updated Successfuly!');

  }

  public static function restoreDefaults()
  {
    self::truncate();

    $data = [
      ['link' => 'shop','murl' => 'shop','mtitle' => 'shop','created_at' => NOW(),'updated_at' => NOW()],
      ['link' => 'about','murl' => 'about','mtitle' => 'about us','created_at' => NOW(),'updated_at' => NOW()],
      ['link' => 'contact','murl' => 'contact','mtitle' => 'contact us','created_at' => NOW(),'updated_at' => NOW()]
    ];

    self::insert($data);
  }
}

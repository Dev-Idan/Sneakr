<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Content extends Model
{
    public static function getByUrl($url,&$data)
    {
    $contents = DB::table('contents as c')
                  ->join('menus as m', 'm.id','=','c.menu_id')
                  ->select('c.*','m.mtitle')
                  ->where('m.murl','=',$url)
                  ->get()->toArray();

                  if (! $contents) {
                    abort(404);
                  }

                  $data['page_title'] = $contents[0]->mtitle;
                  $data['contents'] = $contents;
    }

    public static function save_new($request)
    {

      $content = new self();
      $content->menu_id = $request['menu_id'];
      $content->ctitle = $request['ctitle'];
      $content->carticle = $request['carticle'];

      $content->save();

      Session::flash('successM','Content Added Successfuly!');

    }

    public static function update_item($request,$id)
    {

      $content = self::find($id);
      $content->menu_id = $request['menu_id'];
      $content->ctitle = $request['ctitle'];
      $content->carticle = $request['carticle'];

      $content->save();

      Session::flash('successM','Content Updated Successfuly!');

    }
}

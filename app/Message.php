<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Message extends Model
{
  public static function save_new($request)
  {

    $message = new self();
    $message->name = $request['name'];
    $message->email = $request['email'];
    $message->m_title = $request['subject'];
    $message->m_body = $request['message'];
    $message->is_read = 0;

    $message->save();
    Session::flash('m_sent',true);
  }

  public static function getMessage($id, &$data)
  {
    if ( $data['message'] = self::where('id',$id)->first() ) {

      self::where('id',$id)->update(['is_read' => '1']);

    } else {
      abort('404');
    }
  }


  public static function doAction($mid,$action)
  {
    if (!empty($mid) && is_array($mid)) {

      if ($action == 'read') {

        self::whereIn('id',$mid)->update(['is_read' => '1']);
        Session::flash('successM','Messages Marked as read!');

      } else if ($action == 'unread') {

        self::whereIn('id',$mid)->update(['is_read' => '0']);
        Session::flash('successM','Messages Marked unread!');

      } elseif ($action == 'delete') {

        self::whereIn('id',$mid)->delete();
        Session::flash('successM','Messages Deleted!');

      }

      echo 1;

    } else {
      echo 0;
    }
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Session;

class MessagesController extends CmsController
{
    public function getMessages()
    {
      self::$data['messages'] = Message::orderBy('created_at', 'DESC')->paginate(10);
      return view('cms.messages',self::$data);
    }

    public function getMessage($id)
    {
      Message::getMessage($id, self::$data);
      return view('cms.view_message',self::$data);
    }

    public function doAction(Request $request)
    {
      Message::doAction($request['mid'],$request['action']);
    }
}

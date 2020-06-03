<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Order;
use Session;

class CmsController extends MainController
{
    public function __construct()
    {
      parent::__construct();
      self::$data['unread_messages'] = Message::where('is_read','0')->count('is_read');
    }

    public function dashboard()
    {
      self::$data['monthly_rev'] = Order::whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->sum('total');
      self::$data['monthly_orders'] = Order::whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->count('id');
      self::$data['users_amount'] = User::count();
      return view('cms.index',self::$data);
    }

    public function getGraph(Request $request)
    {
      Order::getGraphInfo($request);
    }

    public function getOrders()
    {
      Order::getAll(self::$data);
      return view('cms.orders',self::$data);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Cart;
use DB;

class Order extends Model
{

  public static function save_new(&$data)
  {
    $order = new self();

    $order->user_id = Session::get('user_id');
    $order->order_data = serialize(Cart::getContent()->toArray());
    $order->total = Cart::getTotal();
    $order->save();

    $data['order_info'] = Cart::getContent()->toArray();
    $data['order_total'] = Cart::getTotal();
    Cart::clear();
  }

  public static function getGraphInfo($request)
  {

    if ($request['auth'] == 'idan1337$$data') {

      $data = [
        'today' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('today')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('today')) )->sum('total')
                   ],
        'yesterday' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('yesterday')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('yesterday')) )->sum('total')
                   ],
        '2 days ago' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('2 days ago')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('2 days ago')) )->sum('total')
                   ],
        '3 days ago' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('3 days ago')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('3 days ago')) )->sum('total')
                   ],
        '4 days ago' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('4 days ago')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('4 days ago')) )->sum('total')
                   ],
        '5 days ago' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('5 days ago')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('5 days ago')) )->sum('total')
                   ],
        '6 days ago' => [
                     'amount' => self::whereDate('created_at', date('Y-m-d', strtotime('6 days ago')) )->count(),
                     'total' => self::whereDate('created_at', date('Y-m-d', strtotime('6 days ago')) )->sum('total')
                   ],

      ];

      echo json_encode($data);
    }

  }

  public static function getAll(&$data)
  {
    $data['orders'] = DB::table('orders AS o')
                      ->join('users AS u','o.user_id','=','u.id')
                      ->select('o.*','u.name')
                      ->orderBy('o.created_at','DESC')
                      ->paginate(13);
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Hash;

class User extends Model
{
  public static function login($email,$password,&$data){

    $verify = false;

    $user = DB::table('users as u')
                ->join('users_roles as ur','u.id','=','ur.user_id')
                ->select('u.*','ur.role_id')
                ->where('u.email','=',$email)
                ->first();

    if ( $user && Hash::check($password,$user->password)) {

      if ($user->role_id == 666) {
        Session::put('is_admin',true);
      }

      if ($user->status == 1) {

        Session::put('user_name',$user->name);
        Session::put('user_id',$user->id);
        Session::put('user_email',$user->email);
        Session::flash('successM','Welcome back ' . $user->name . ' !');
        $data['account_status'] = true;

      } else {

        $data['account_status'] = false;
      }

      $verify = true;
    }


    return $verify;
  }

  public static function save_new($request){

    $user = new self();
    $user->name = $request['name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->save();

    $uid = $user->id;
    DB::insert("INSERT INTO users_roles VALUES(NULL,$uid,1)");

    Session::put('user_name',$user->name);
    Session::put('user_id',$user->id);
    Session::put('user_email',$user->email);
    Session::flash('successM','Welcome to Sneakr ' . $user->name);

  }

  public static function getAccountData(&$data)
  {
    $data['user_orders'] = Order::orderBy('created_at','ASC')->where('user_id',Session::get('user_id'))->get()->toArray();
    $data['order_iteration'] = 1;
  }

  public static function updateAccount($request)
  {
    $user = User::find(Session::get('user_id'));
    $user->name = $request['name'];
    $user->email = $request['email'];
    if ($request['password']) {
      $user->password = bcrypt($request['password']);
    }
    $user->save();

    Session::put('user_name',$user->name);
    Session::put('user_id',$user->id);
    Session::put('user_email',$user->email);
    Session::flash('successM','Account Updated Successfully');
  }

  public static function getUserOrder($oid,&$data)
  {
    if (is_numeric($oid)) {
      if (Order::where('id',$oid)->where('user_id',Session::get('user_id'))->first()) {

        $data['order_total'] = Order::where('id',$oid)->pluck('total')->first();
        $data['order_info'] = unserialize(Order::where('id',$oid)->pluck('order_data')->first());

      } else {
        abort(401);
      }
    } else {
      abort(404);
    }
  }

  public static function getUsers(&$data)
  {

    $data['users'] = DB::table('users AS u')
                      ->join('users_roles AS ur','u.id','=','ur.user_id')
                      ->select('u.id','u.name','u.email','u.created_at','u.status','ur.role_id')
                      ->paginate(13);

  }

  public static function save_cms($request)
  {
    $user = new self();
    $user->name = $request['name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->status = $request['status'];
    $user->save();

    $uid = $user->id;
    $urole = $request['role'];
    DB::insert("INSERT INTO users_roles VALUES(NULL,$uid,$urole)");

    Session::flash('successM','User Added Successfuly!');
  }

  public static function update_cms($request, $id)
  {

    $user = self::find($id);
    $user->name = $request['name'];
    $user->email = $request['email'];
    $user->status = $request['status'];

    if (! empty($request['password'])) {
      $user->password = bcrypt($request['password']);
    }

    $user->save();

    $uid = $user->id;
    $urole = $request['role'];
    DB::table('users_roles')->where('user_id',$uid)->update(['role_id' => $urole]);

    Session::flash('successM','User Updated Successfuly!');

  }
}

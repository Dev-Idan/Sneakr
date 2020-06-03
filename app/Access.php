<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Hash;

class Access extends Model
{
  public static function login($user,$password,&$data){

    $verify = false;

    $user = DB::table('access as a')
                ->select('a.*')
                ->where('a.user','=',$user)
                ->first();

    if ( $user && Hash::check($password,$user->password)) {

      Session::put('is_granted',true);
      $verify = true;
    }

    return $verify;
  }
}

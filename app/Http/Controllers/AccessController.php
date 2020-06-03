<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Access;
use Session;

class AccessController extends MainController
{

  public function __construct()
  {
    parent::__construct();
  }


  public function getLogin()
  {
    self::$data['page_title'] = '| Get Access';
    return view('access.login',self::$data);
  }


  public function postLogin(Request $request)
  {

    if ( Access::login($request['user'],$request['password'],self::$data) ) {

      return redirect('/');

    } else {

      return redirect('access');
    }
  }

}

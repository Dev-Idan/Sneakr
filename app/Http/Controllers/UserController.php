<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UpdateAccRequest;
use App\User;
use Session;

class UserController extends MainController
{

  public function __construct()
  {
    parent::__construct();
    $this->middleware('userguard', ['except' => ['logout','getAccount','getUserOrder','updateAccount']]);
    $this->middleware('userguardtwo', ['only' => ['getAccount','getUserOrder','updateAccount']]);
  }

  public function getLogin()
  {
    self::$data['page_title'] = '| Login';
    return view('pages.login',self::$data);
  }

  public function postLogin(LoginRequest $request)
  {

    $redirect_to = !empty($request['redirect']) ? $request['redirect'] : '';

    if ( User::login($request['email'],$request['password'],self::$data) ) {

      if (self::$data['account_status']) {

        return redirect($redirect_to);

      } else {

        self::$data['page_title'] = '| Login';
        self::$data['status_error'] = 'Your account has been suspended, Please contact site\'s manager';
        return view('pages.login',self::$data);
      }
    } else {

      self::$data['page_title'] = '| Login';
      self::$data['login_error'] = 'Wrong email or password';
      return view('pages.login',self::$data);

    }
  }

  public function getSignup()
  {
    self::$data['page_title'] = '| Sign up';
    return view('pages.signup',self::$data);
  }

  public function postSignup(SignupRequest $request)
  {
    User::save_new($request);
    return redirect('');
  }

  public function getAccount()
  {
    self::$data['page_title'] = '| My Account';
    User::getAccountData(self::$data);
    return view('pages.account',self::$data);
  }

  public function updateAccount(UpdateAccRequest $request)
  {
    User::updateAccount($request);
    return redirect('account');
  }

  public function getUserOrder($oid)
  {
    User::getUserOrder($oid,self::$data);
    self::$data['page_title'] = '| View Order';
    return view('pages.view_order', self::$data);
  }

  public function logout()
  {
    $access = Session::get('is_granted');
    Session::flush();
    Session::put('is_granted', $access);
    return redirect('login');
  }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\NewUserRequest;

class CmsUserController extends CmsController
{

    public function index()
    {
      User::getUsers(self::$data);
      return view('cms.users',self::$data);
    }


    public function create()
    {
      self::$data['roles'] = [['id' => '1','role' => 'Regular User'],['id' => '666','role' => 'Administrator']];
      self::$data['statuses'] = [['id' => '1','status' => 'Active'],['id' => '0','status' => 'Disabled']];
      return view('cms.add_user', self::$data);
    }


    public function store(NewUserRequest $request)
    {
      User::save_cms($request);
      return redirect('cms/users');
    }


    public function show($id)
    {
      self::$data['uname'] = User::where('id',$id)->pluck('name')->first();
      self::$data['item_id'] = $id;
      return view('cms.delete_user', self::$data);
    }


    public function edit($id)
    {
      self::$data['roles'] = [['id' => '1','role' => 'Regular User'],['id' => '666','role' => 'Administrator']];
      self::$data['statuses'] = [['id' => '1','status' => 'Active'],['id' => '0','status' => 'Disabled']];
      self::$data['user_item'] = User::find($id)->toArray();
      self::$data['user_role'] = DB::table('users_roles')->where('user_id',$id)->pluck('role_id')->first();
      return view('cms.edit_user',self::$data);
    }


    public function update(NewUserRequest $request, $id)
    {
      User::update_cms($request, $id);
      return redirect('cms/users');
    }


    public function destroy($id)
    {
      User::destroy($id);
      DB::table('users_roles')->where('user_id',$id)->delete();
      Session::flash('successM','User has been removed!');
      return redirect('cms/users');
    }
}

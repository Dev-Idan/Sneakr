@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add User</h1>
  </div>

  <div class="row">
    <div class="col-6">
      <form action="{{ url('cms/users/' . $user_item['id']) }}" method="POST" novalidate autocomplete="off">
        @method('PUT')
        @csrf

        <input type="hidden" name="item_id" value="{{ $user_item['id'] }}">
        <input type="hidden" name="eval_pw" value="no">

        <div class="row">

          <div class="col-6">
            <div class="form-group">
              <label for="role" class="text-dark"><span class="text-danger">*</span> User Role</label>
              <select name="role" id="role" class="form-control select-fix">
                @foreach ($roles as $item)
                  <option @if ($user_role == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['role'] }}</option>
                @endforeach
              </select>
              <small class="text-muted">Change role of user</small><br>
              <span class="text-danger">{{ $errors->first('role') }}</span>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="status" class="text-dark"><span class="text-danger">*</span> Account Status</label>
              <select name="status" id="status" class="form-control select-fix">
                @foreach ($statuses as $item)
                  <option @if ($user_item['status'] == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['status'] }}</option>
                @endforeach
              </select>
              <small class="text-muted">Change account status</small><br>
              <span class="text-danger">{{ $errors->first('status') }}</span>
            </div>
          </div>

        </div>

        <div class="form-group">
          <label for="name" class="text-dark"><span class="text-danger">*</span> Name</label>
          <input type="text" name="name" id="name" class="form-control field-input-cms mb-1" value="{{ $user_item['name'] }}">
          <small class="text-muted">The User's name, min 2 chars max 70 chars</small><br>
          <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group">
          <label for="email" class="text-dark"><span class="text-danger">*</span> Email</label>
          <input type="email" name="email" id="email" class="form-control field-input-cms mb-1" value="{{ $user_item['email'] }}">
          <small class="text-muted">The User's email</small><br>
          <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group">
          <label for="password" class="text-dark"><span class="text-danger">*</span> Password</label>
          <input type="text" name="password" id="password" class="form-control field-input-cms mb-1" value="{{ old('password') }}">
          <small class="text-muted">The User's password, min 2 chars max 20 chars</small><br>
          <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>

        <input type="submit" value="Update User" name="submit" class="btn btn-lg btn-primary mt-3">
        <a href="{{ url('cms/users') }}" class="btn btn-lg btn-block btn-secondary mt-2">Cancel</a>

      </form>
    </div>
  </div>

@endsection

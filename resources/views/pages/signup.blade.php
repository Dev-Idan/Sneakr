@extends('layouts.app')

@section('extraCSS')
  <style media="screen">

    main{
      background-image: url({{ asset('lib/indecor/img/bg/home1-bg1.jpg') }});
      background-repeat: repeat;
      background-position: center;
    }

  </style>
@endsection

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto mt-5 py-3">
        <h1 class="text-center display-2 font-weight-bold">Sign up</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-lg-6 mx-auto my-5 px-5">
        <form action="" method="POST" autocomplete="off" novalidate>
          @csrf()
          <div class="form-group">
            <label for="name" class="h6"><span class="text-danger">*</span> Name:</label>
            <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Whats your name?" value="{{ old('name') }}">
            <span class="text-danger">{{ $errors->first('name') }}</span>
          </div>
          <div class="form-group">
            <label for="email" class="h6"><span class="text-danger">*</span> Email:</label>
            <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email goes here" value="{{ old('email') }}">
            <span class="text-danger">{{ $errors->first('email') }}</span>
          </div>
          <div class="form-group">
            <label for="password" class="h6"><span class="text-danger">*</span> Password:</label>
            <input type="password" name="password" id="password" placeholder="Password here" class="form-control mb-2">
            <span class="text-danger">{{ $errors->first('password') }}</span>
          </div>
          <div class="form-group">
            <label for="password-confirmation" class="h6"><span class="text-danger">*</span> Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password-confirmation" placeholder="Password again" class="form-control mb-2">
          </div>
          <input type="submit" name="submit" value="Sign up" class="btn btn-dark font-weight-bold">
        </form>
        <p class="text-muted text-center font-italic mt-4">Already have an account? <a href="{{ url('login') }}" class="text-primary">Login!</a></p>
      </div>
    </div>
  </div>
@endsection

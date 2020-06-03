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
      <div class="col-md-6 mx-auto mt-5 pt-4">
        <h1 class="text-center display-2 font-weight-bold">Log in</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-lg-6 mx-auto my-5 px-5">
        <form action="" method="POST" autocomplete="off" novalidate>
          @csrf()
          <div class="form-group">
            <label for="email" class="h6"><span class="text-danger">*</span> Email:</label>
            <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email goes here" value="{{ old('email') }}">
            <span class="text-danger">{{ $errors->first('email') }}</span>
          </div>
          <div class="form-group">
            <label for="password" class="h6"><span class="text-danger">*</span> Password:</label>
            <input type="password" name="password" id="password" placeholder="Password please" class="form-control mb-2">
            <span class="text-danger">{{ $errors->first('password') }}</span>
          </div>

          @if (! empty($login_error))
            <div class="alert alert-danger mt-2" role="alert">
            <span class="text-dark"><i class="fas fa-exclamation-circle"></i> {{ $login_error }}</span>
            </div>
          @endif

          @if (! empty($status_error))
            <div class="alert alert-warning mt-2" role="alert">
            <span class="text-dark"><i class="fas fa-exclamation-triangle"></i> {{ $status_error }} (<a target="_blank" class="text-info" href="{{ url('contact') }}">Contact page</a>)</span>
            </div>
          @endif

          <input type="submit" name="submit" value="Login" class="btn btn-dark font-weight-bold">

        </form>
        <p class="text-muted text-center font-italic mt-4">Don't have an account? <a href="{{ url('signup') }}" class="text-primary">Sign up!</a></p>
      </div>
    </div>
  </div>
@endsection

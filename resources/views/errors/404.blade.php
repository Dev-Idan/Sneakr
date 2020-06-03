@extends('layouts.app')

@section('content')

      <div class="error-404-area pb-80">
          <div class="container">
              <div class="row py-5">
                  <div class="col-md-12">
                      <div class="error-wrapper text-center">
                          <div class="error-text">
                              <h1>404</h1>
                              <h2>Oops! PAGE NOT FOUND</h2>
                              <p>Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarily unavailable.</p>
                          </div>
                          <div class="error-button">
                              <a href="{{ url('') }}">Back to home page</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
@endsection

@extends('layouts.app')

@section('content')

      <div class="error-404-area pb-80">
          <div class="container">
              <div class="row py-5">
                  <div class="col-md-12">
                      <div class="error-wrapper text-center">
                          <div class="error-text">
                              <h1>401</h1>
                              <h2>Unauthorized</h2>
                              <p>Sorry but you don't have access to the page you're trying to reach.</p>
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

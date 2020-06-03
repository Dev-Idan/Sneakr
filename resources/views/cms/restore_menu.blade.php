@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Restore Menu Defaults</h1>
  </div>

  <div class="row">
    <div class="col-6 mx-auto text-center mt-4">
      <div class="alert alert-dark pt-5 pb-4" role="alert">
        <h2 class="alert-heading">Are you sure you want to restore menu defaults?</h2>
        <p class="mt-4 h6">this action will delete any changes you have made to the site's original menu.</p>
        <hr class="my-3">
        <form class="mt-4" action="{{ url('cms/menu/restore-defaults') }}" method="POST">
          @csrf
          <a href="{{ url('cms/menu') }}" class="btn btn-lg btn-secondary mr-2">Cancel</a>
          <button type="submit" class="btn btn-lg btn-danger">Restore Menu Defaults</button>
        </form>
      </div>
    </div>
  </div>


@endsection

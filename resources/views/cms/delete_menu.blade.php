@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Delete Menu</h1>
  </div>

  <div class="row">
    <div class="col-6 mx-auto text-center mt-4">
      <div class="alert alert-dark py-5" role="alert">
        <h2 class="alert-heading">Are you sure you want to delete this menu?</h2>
        <hr>
        <form action="{{ url('cms/menu/' . $item_id) }}" method="POST">
          @method('DELETE')
          @csrf
          <a href="{{ url('cms/menu') }}" class="btn btn-lg btn-secondary mr-2">Cancel</a>
          <button type="submit" class="btn btn-lg btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>


@endsection

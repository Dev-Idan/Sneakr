@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Shop Categories</h1>
  </div>
  <p>
    <a href="{{ url('cms/categories/create') }}" class="btn btn-lg btn-primary">Add Category</a>
  </p>
  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>Category</th>
          <th>Category Image</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $item)
          <tr>
            <td class="align-middle">{{ $item['ctitle'] }}</td>
            <td class="align-middle"><img width="100" src="{{ asset('imgs/categories/' . $item['cimage']) }}"></td>
            <td class="align-middle">
              <a href="{{ url('cms/categories/' . $item['id'] . '/edit') }}" class="text-secondary btn"><i class="fas fa-pencil-alt"></i></a>
              <a href="{{ url('cms/categories/' . $item['id']) }}" class="text-danger"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

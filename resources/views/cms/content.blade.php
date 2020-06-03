@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Site Content</h1>
  </div>
  <p>
    <a href="{{ url('cms/content/create') }}" class="btn btn-lg btn-primary">Add Content</a>
  </p>
  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>Title</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contents as $item)
          <tr>
            <td class="align-middle">{{ $item['ctitle'] }}</td>
            <td>
              <a href="{{ url('cms/content/' . $item['id'] . '/edit') }}" class="text-secondary btn"><i class="fas fa-pencil-alt"></i></a>
              <a href="{{ url('cms/content/' . $item['id']) }}" class="text-danger"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

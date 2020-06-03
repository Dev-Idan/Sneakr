@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Site Menu</h1>
  </div>
  <p>
    <a href="{{ url('cms/menu/create') }}" class="btn btn-lg btn-primary">Add Menu link</a>
    <a href="{{ url('cms/menu/restore-defaults') }}" class="btn btn-lg btn-secondary float-right">Restore Defaults</a>
  </p>
  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>Link</th>
          <th>Title</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($menus as $item)
          <tr>
            <td class="align-middle">{{ $item['link'] }}</td>
            <td class="align-middle">{{ $item['mtitle'] }}</td>
            <td>
              <a href="{{ url('cms/menu/' . $item['id'] . '/edit') }}" class="text-secondary btn"><i class="fas fa-pencil-alt"></i></a>
              <a href="{{ url('cms/menu/' . $item['id']) }}" class="text-danger"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

@extends('cms.layout')

@section('extraCSS')
  <style media="screen">

    .is_admin{
      font-weight: 500;
    }

  </style>
@endsection

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Users</h1>
  </div>

  <p>
    <a href="{{ url('cms/users/create') }}" class="btn btn-lg btn-primary">Add User</a>
  </p>

  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Date Joined</th>
          <th>User Role</th>
          <th>Account Status</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $item)

          <tr>
            <td class="align-middle">{{ $item->id }}</td>
            <td class="align-middle">{{ $item->name }}</td>
            <td class="align-middle">{{ $item->email }}</td>
            <td class="align-middle">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
            <td class="align-middle">
              @if ($item->role_id == 666)
                <span class="badge badge-danger p-2">Administrator</span>
              @else
                <span class="badge badge-secondary p-2">Regular user</span>
              @endif
            </td>
            <td class="align-middle">
              @if ($item->status == 1)
                <span class="text-success"><i class="fas fa-circle"></i></span>
              @else
                <span class="text-danger"><i class="fas fa-circle"></i></span>
              @endif
            </td>
            <td class="align-middle">
              <a href="{{ url('cms/users/' . $item->id . '/edit') }}" class="text-secondary btn"><i class="fas fa-pencil-alt"></i></a>
              <a href="{{ url('cms/users/' . $item->id) }}" class="text-danger"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>

        @endforeach
      </tbody>
    </table>
  </div>

  <div class="product-pagination">
      {{ $users->links() }}
  </div>

@endsection

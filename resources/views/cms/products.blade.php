@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Shop Products</h1>
  </div>
  <p>
    <a href="{{ url('cms/products/create') }}" class="btn btn-lg btn-primary">Add Product</a>
  </p>
  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>Product</th>
          <th>Product Image</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $item)
          <tr>
            <td class="align-middle">{{ $item->ptitle }}</td>
            <td class="align-middle"><img width="100" src="{{ asset('imgs/products/' . $item->pimage) }}"></td>
            <td class="align-middle">
              <a href="{{ url('cms/products/' . $item->id . '/edit') }}" class="text-secondary btn"><i class="fas fa-pencil-alt"></i></a>
              <a href="{{ url('cms/products/' . $item->id) }}" class="text-danger"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="product-pagination">
      {{ $products->links() }}
  </div>

@endsection

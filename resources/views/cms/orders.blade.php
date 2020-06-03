@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">View Orders</h1>
  </div>

  <div class="table-responsive mt-5">
    <table class="table table-striped table-sm text-center mb-0">
      <thead>
        <tr>
          <th>User</th>
          <th>Order Details</th>
          <th>Total</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $item)
          <tr>
            <td class="align-middle">{{ $item->name }}</td>
            <td class="align-middle"><button type="button" data-toggle="modal" data-target="#order-{{ $item->id }}" class="btn btn-info btn-sm">View Order</button></td>
            <td class="align-middle">${{ $item->total }}</td>
            <td class="align-middle">{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
          </tr>

          <div class="modal fade" id="order-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header mb-3">
                  <h3 class="modal-title">Order Details</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @foreach (unserialize($item->order_data) as $product)
                    <div class="row">
                      <div class="col-4">
                        <img class="img-fluid mx-auto d-block" src="{{ asset('imgs/products/' . $product['attributes']['image']) }}" width="100">
                      </div>
                      <div class="col-8">
                          <p class="h6">{{ $product['name'] }}</p>
                          <ul class="ml-3">
                            <li>Quantity: {{ $product['quantity'] }}</li>
                            <li>Price per unit: ${{ $product['price'] }}</li>
                          </ul>
                      </div>
                    </div>
                    <hr class="my-4">
                  @endforeach
                  <h3 class="text-center">Total : ${{ $item->total }}</h3>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        @endforeach
      </tbody>
    </table>
  </div>

  <div class="product-pagination">
      {{ $orders->links() }}
  </div>

@endsection

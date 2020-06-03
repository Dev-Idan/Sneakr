@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="your-order py-5 my-5">
          <h1 class="display-3 text-center">Thanks for your purchase!</h1>
          <h3 class="text-center mt-5">Your order details</h3>
          <div class="your-order-table table-responsive">
              <table class="table mt-3">
                  <thead>
                      <tr>
                          <th></th>
                          <th class="cart-product-name">Product</th>
                          <th class="cart-product-total">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($order_info as $item)
                        <tr class="cart_item">
                          <td><img src="{{ asset('imgs/products/' . $item['attributes']['image']) }}" width="150" alt="Product image"></td>
                          <td class="cart-product-name align-middle"> {{ $item['name'] }}<strong class="product-quantity"> × {{ $item['quantity'] }}</strong></td>
                          <td class="cart-product-total align-middle"><span class="amount">${{ ($item['price'] * $item['quantity']) }}.00</span></td>
                        </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                      <tr class="order-total">
                          <th>Order Total</th>
                          <th></th>
                          <td><strong><span class="amount">${{ $order_total }}.00</span></strong></td>
                      </tr>
                  </tfoot>
              </table>
          </div>
          <div class="order-button-payment">
            <a href="{{ url('') }}" class="btn btn-lg btn-block btn-dark py-3"><span class="arrow_back"></span> Back to Home Page</a>
          </div>
		  </div>
    </div>
  </div>
@endsection

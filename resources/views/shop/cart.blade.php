@extends('layouts.app')

@section('content')

  @if($cart)
  <div class="Shopping-cart-area pb-80">
  		    <div class="container">
  		        <div class="row">
  		            <div class="col-12">
                      <h1 class="display-3 text-center mb-5">Your Cart Items:</h1>
  		                <form action="#">
  		                    <div class="table-content table-responsive">
  		                        <table class="table">
  		                            <thead>
  		                                <tr>
  		                                    <th class="indecor-product-thumbnail d-md-block d-none">image</th>
  		                                    <th class="cart-product-name">Product</th>
  		                                    <th class="indecor-product-price">Unit Price</th>
  		                                    <th class="indecor-product-quantity">Quantity</th>
  		                                    <th class="indecor-product-subtotal">Total</th>
                                          <th class="indecor-product-remove"></th>
  		                                </tr>
  		                            </thead>
  		                            <tbody>
                                    @foreach ($cart as $item)
  		                                <tr>
  		                                    <td class="indecor-product-thumbnail d-md-table-cell d-none"><a href="{{ url('shop/' . $item['attributes']['url']) }}"><img width="100" src="{{ asset('imgs/products/' . $item['attributes']['image']) }}" alt="product image"></a></td>
  		                                    <td class="indecor-product-name"><a href="{{ url('shop/' . $item['attributes']['url']) }}">{{ $item['name'] }}</a></td>
  		                                    <td class="indecor-product-price"><span class="amount">${{ $item['price'] }}.00</span></td>
  		                                    <td class="indecor-product-quantity">
                                            <div class="d-flex justify-content-center align-items-center">
                                              <a href="{{ url('cart/update/minus/' . $item['id']) }}"><i class="fas fa-minus-circle"></i></a>
                                              <input type="text" class="text-center" value="{{ $item['quantity'] }}">
                                              <a href="{{ url('cart/update/plus/' . $item['id']) }}"><i class="fas fa-plus-circle"></i></a>
                                            </div>
                                          </td>
  		                                    <td class="product-subtotal"><span class="amount">${{ $item['price'] * $item['quantity'] }}</span></td>
                                          <td class="indecor-product-remove"><a href="{{ url('cart/remove-item/' . $item['id']) }}"><i class="far fa-trash-alt"></i></a></td>
  		                                </tr>
                                    @endforeach
  		                            </tbody>
  		                        </table>
  		                    </div>
                          <div class="row">
		                        <div class="col-12">
		                            <div class="coupon-all">
		                                <div class="coupon2">
                                        <a href="{{ url('cart/clear')}}" class="btn btn btn-light">Empty Cart</a>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
  		                    <div class="row">
  		                        <div class="col-md-5 ml-auto">
  		                            <div class="cart-page-total">
  		                                <h2>Cart totals</h2>
  		                                <ul>
  		                                    <li>Total <span>${{ Cart::getTotal() }}.00</span></li>
  		                                </ul>
  		                                <a href="{{ url('shop/order-complete') }}" class="btn btn-lg btn-primary">Complete Order</a>
  		                            </div>
  		                        </div>
  		                    </div>
  		                </form>
  		            </div>
  		        </div>
  		    </div>
  		</div>
    @else
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="display-3 text-center mt-5">Your cart is Empty!</h2>
            <p class="text-center mt-5 h5">Add some products to continue..</p>
            <a href="{{ url('shop') }}" class="btn btn-lg btn-dark mt-4 px-4">Enter Shop</a>
          </div>
        </div>
      </div>
    @endif

@endsection

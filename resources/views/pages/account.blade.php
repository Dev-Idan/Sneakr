@extends('layouts.app')

@section('extraJS')
<script>

window.onload = function() {

  if ( {{ $errors->toArray() != [] ? '1' : '0' }} ) {
    $('.single-slide-menu a').removeClass('active');
    $('a.acc-dets').addClass('active');
    $('.product-details-large .tab-pane').removeClass('active show');
    $('div#account-details' ).addClass('active show');

  } else {

    $('.single-slide-menu a').removeClass('active');
    $('a.dshbrd').addClass('active');
    $('.product-details-large .tab-pane').removeClass('active show');
    $('div#dashboard').addClass('active show');
  }

}

</script>
@endsection

@section('content')

  <div class="breadcrumb-area pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="breadcrumb-bg py-5">
                <h1 class="display-4">Manage Account</h1>
              </div>
            </div>
        </div>
    </div>
  </div>

  <!--My Account Area Strat-->
  <div class="my-account white-bg pb-80">
          <div class="container">
              <div class="account-dashboard">
                 <div class="dashboard-upper-info">
                     <div class="row align-items-center no-gutters">
                         <div class="col-lg-3 col-md-12">
                             <div class="d-single-info">
                                 <p class="user-name">Hello <span>{{ Session::get('user_name') }}</span></p>
                             </div>
                         </div>
                         <div class="col-lg-4 col-md-12">
                             <div class="d-single-info">
                                 <p>Need Assistance? Customer service at</p>
                                 <p>admin@SneakrHelp.com.</p>
                             </div>
                         </div>
                         <div class="col-lg-3 col-md-12">
                             <div class="d-single-info">
                                 <p>E-mail them at </p>
                                 <p>support@SneakrHelp.com</p>
                             </div>
                         </div>
                         <div class="col-lg-2 col-md-12">
                             <div class="d-single-info text-lg-center">
                                 <a class="view-cart" href="{{ url('cart') }}"><i class="fa fa-cart-plus"></i>view cart</a>
                             </div>
                         </div>
                     </div>
                 </div>
                  <div class="row">
                      <div class="col-md-12 col-lg-2">
                          <!-- Nav tabs -->
                          <ul class="nav flex-column dashboard-list" role="tablist">
                              <li><a class="nav-link dshbrd" data-toggle="tab" href="#dashboard">Dashboard</a></li>
                              <li> <a class="nav-link" data-toggle="tab" href="#orders">Orders</a></li>
                              <li><a class="nav-link acc-dets" data-toggle="tab" href="#account-details">Account details</a></li>
                              <li><a class="nav-link" href="{{ url('logout') }}">logout</a></li>
                          </ul>
                      </div>
                      <div class="col-md-12 col-lg-10">
                          <!-- Tab panes -->
                          <div class="tab-content dashboard-content">
                              <div id="dashboard" class="tab-pane fade">
                                  <h3>Dashboard </h3>
                                  <p>From your account dashboard. you can easily check &amp; view your recent orders, manage your account details and edit your password.</p>
                              </div>
                              <div id="orders" class="tab-pane fade">
                                  <h3>Orders</h3>
                                      @if ($user_orders)
                                      <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user_orders as $order)
                                                  <tr>
                                                      <td>{{$order_iteration++}}</td>
                                                      <td>{{date('d/m/Y H:i:s',strtotime($order['created_at']))}}</td>
                                                      <td>${{ $order['total'] }}.00 for {{count(unserialize($order['order_data']))}} item{{ count(unserialize($order['order_data'])) == 1 ? '' : 's' }} </td>
                                                      <td><a class="view" href="{{ url('account/view-order/' . $order['id']) }}">view</a></td>
                                                  </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                      @else
                                        <div class="text-center">
                                          <h4 class="display-4 mt-5">No orders found.</h4>
                                          <a href="{{ url('shop') }}" class="btn btn-dark mt-3 mb-4">Shop Now!</a>
                                        </div>
                                      @endif
                              </div>
                              <div id="account-details" class="tab-pane fade">
                                  <h3>Account details </h3>
                                  <div class="login">
                                      <div class="login-form-container">
                                          <div class="account-login-form">
                                              <form action="" method="POST" autocomplete="off" novalidate>
                                                @csrf()
                                                <div>
                                                  <label for="name">Full Name</label>
                                                  <input name="name" type="text" id="name" value="{{ old('name') ?? Session::get('user_name') }}">
                                                  <span class="text-danger">{{ $errors->first('name') }}</span>
                                                </div>
                                                <div>
                                                  <label for="email">Email</label>
                                                  <input name="email" type="email" id="email" value="{{ old('email') ?? Session::get('user_email') }}">
                                                  <span class="text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                                <div>
                                                  <label for="password">Password</label>
                                                  <input name="password" type="password" id="password">
                                                  <span class="text-danger">{{ $errors->first('password') }}</span>
                                                </div>
                                                <div>
                                                  <label for="password-confirmation">Confirm Password</label>
                                                  <input name="password_confirmation" id="password-confirmation" type="password">
                                                </div>
                                                <div class="button-box">
                                                    <button type="submit" class="default-btn">save</button>
                                                </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!--My Account Area End-->

@endsection

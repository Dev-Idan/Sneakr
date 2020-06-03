@extends('layouts.app')

@section('extraCSS')

  <style media="screen">

    img.match-blat4{
      object-fit: cover;
    }

  </style>

@endsection

@section('extraJS')
  <script>

  $(function() {
    $('.match-blat1').matchHeight();
    $('.match-blat2').matchHeight();
    $('.match-blat3').matchHeight();
    $('.match-blat4').matchHeight();
    $('.match-blat5').matchHeight();
    $('.match-blat6').matchHeight();
  });

  </script>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

      <div class="container">
        <div class="row mb-4">
          <div class="col-12 mt-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('shop') }}">Shop</a></li>
                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('shop/' . $product['curl']) }}">{{ ucfirst($product['curl']) }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['ptitle'] }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>


        <!--Single Product Area Start-->
    		<div class="single-product-area pb-70">
    		    <div class="container">
    		        <div class="row">
    		            <div class="col-md-12 col-lg-6">
    		                <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-lg-image-1">
                                    {{-- main image --}}
                                    <div class="lg-image">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="{{ asset('imgs/products/' . $product['pimage']) }}">
                                              <img src="{{ asset('imgs/products/' . $product['pimage']) }}" alt="product main image">
                                            </a>
                                            <a href="{{ asset('imgs/products/' . $product['pimage']) }}" class="popup-img venobox" data-gall="myGallery"><i class="fa fa-expand"></i></a>
                                         </div>
                                    </div>

                                    {{-- extra images if exsist --}}
                                    @if ($product['pgallery'][0])
                                        @foreach ($product['pgallery'] as $pgallery)
                                          <div class="lg-image">
                                              <div class="easyzoom easyzoom--overlay">
                                                  <a href="{{ asset('imgs/products/' . $pgallery) }}">
                                                    <img src="{{ asset('imgs/products/' . $pgallery) }}" alt="product main image">
                                                  </a>
                                                  <a href="{{ asset('imgs/products/' . $pgallery) }}" class="popup-img venobox" data-gall="myGallery"><i class="fa fa-expand"></i></a>
                                               </div>
                                          </div>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- if extra images exsist --}}
                                @if ($product['pgallery'][0])
                                  <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image">
                                      <img src="{{ asset('imgs/products/' . $product['pimage']) }}" alt="product image thumb">
                                    </div>
                                    @foreach ($product['pgallery'] as $pgallery)
                                      <div class="sm-image">
                                        <img src="{{ asset('imgs/products/' . $pgallery) }}" alt="product image thumb">
                                      </div>
                                    @endforeach
                                  </div>
                                @endif


                            </div>
                            <!--Product Details Left -->
    		            </div>
    		            <div class="col-md-12 col-lg-6">
                            <!--Product Details Content Start-->
    		                <div class="product-details-content">
    		                    <h2>{{ $product['ptitle'] }}</h2>
                                <div class="single-product-price mt-3">
                                    <span class="price new-price">${{ $product['price'] }}.00</span>
                                </div>
                                <div class="product-description">
                                    <p>{!! $product['particle'] !!}</p>
                                </div>
                                <div class="single-product-quantity">
                                    <form class="add-quantity" action="#">
                                        <div class="add-to-link">
                                          @if(! Cart::get($product['id']))
                                            <input data-pid="{{ $product['id'] }}" type="button" value="Add To Cart" class="product-btn add-to-cart-btn">
                                          @else
                                            <input disabled type="button" value="In Cart" class="btn btn-secondary add-to-cart-btn">
                                          @endif
                                        </div>
                                    </form>
                               </div>
                                <div class="product-meta">
                                    <span class="posted-in">
                                            Categories:
    		                                <a href="{{ url('shop/' . $product['curl']) }}">{{ $product['curl'] }}</a>
    		                            </span>
                                </div>
                                <div class="single-product-sharing">
                                    <h3>Share this product</h3>
                                    <ul>
                                        <li><a target="_blank" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                        <li><a target="_blank" href="https://twitter.com/home"><i class="fa fa-twitter"></i></a></li>
                                        <li><a target="_blank" href="https://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a target="_blank" href="https://aboutme.google.com/u/0/"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a target="_blank" href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
    		                </div>
    		                <!--Product Details Content End-->
    		            </div>
    		        </div>
    		    </div>
    		</div>
    		<!--Single Product Area End-->


        <!--Related Products Area Start-->
    		<div class="related-products-area pb-35">
    		    <div class="container">

    		        <div class="row">
    		            <div class="col-12">
    		                <div class="section-title2">
    		                    <h2>Related Products</h2>
    		                </div>
    		            </div>
    		        </div>

    		        <div class="row">
    		            <div class="col-12">
                      <div class="row">
                          <div class="product-slider owl-carousel">

                                @foreach ($product_lookalike as $item)
                                <!--Single Product Area Start-->
                                <div class="col-md-12 match-blat1">
                                  <div class="single-product-area mb-40 match-blat2">
                                      <div class="product-img img-full match-blat3">
                                          <a href="{{ url('shop/' . $item->curl . '/' . $item->purl) }}">
                                              <img class="first-img match-blat4" src="{{ asset('imgs/products/' . $item->pimage) }}" alt="related product image">
                                          </a>
                                          <span class="sticker">New</span>
                                      </div>
                                      <div class="product-content match-blat5">
                                          <h4><a href="{{ url('shop/' . $item->curl . '/' . $item->purl) }}">{{ $item->ptitle }}</a></h4>
                                          <div class="product-price match-blat6">
                                              <span class="now-price">${{ $item->price }}.00</span>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                <!--Single Product Area End-->
                                @endforeach


                          </div>
                        </div>
                      </div>
    		            </div>
		        </div>
		    </div>
            <!--Related Products Area End-->


      </div>
    </div>
  </div>
@endsection

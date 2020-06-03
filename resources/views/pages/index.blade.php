@extends('layouts.app')


@section('content')
<!--Slider Area Start-->
<div class="slider-area">
    <div class="hero-slider owl-carousel">
        <!--Single Slider Start-->
        <div class="single-slider" style="background-image: url({{ asset('imgs/banners/sneakers-banner.png') }})">
                <div class="hero-slider-content">
                    <h2>In need of a new shoe?</h2>
                    <div class="slider-btn">
                        <a href="{{ url('shop/sneakers') }}" class="btn btn-dark btn-lg mt-5 py-3 px-4">Shop Sneakers</a>
                    </div>
                </div>
        </div>
        <!--Single Slider End-->
        <!--Single Slider Start-->
        <div class="single-slider" style="background-image: url({{ asset('imgs/banners/clothing-banner.png') }})">
                <div class="hero-slider-content">
                    <h2>Maybe a Jacket?</h2>
                    <div class="slider-btn">
                        <a href="{{ url('shop/clothing') }}" class="btn btn-dark btn-lg mt-5 py-3 px-4">Shop Clothing</a>
                    </div>
                </div>
        </div>
        <!--Single Slider End-->
        <!--Single Slider Start-->
        <div class="single-slider" style="background-image: url({{ asset('imgs/banners/accessories-banner.png') }})">
                <div class="hero-slider-content">
                    <h2>How about a bag?</h2>
                    <div class="slider-btn">
                        <a href="{{ url('shop/accessories') }}" class="btn btn-dark btn-lg mt-5 py-3 px-4">Shop Accessories</a>
                    </div>
                </div>
        </div>
        <!--Single Slider End-->
    </div>
</div>
<!--Slider Area End-->


<!--Feature Area Start-->
<div class="feature-area pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!--Single Feature Area Start-->
                <div class="single-feature-area mb-30">
                    <div class="feature-content">
                        <h3>free shipping worldwide</h3>
                    </div>
                </div>
                <!--Single Feature Area End-->
            </div>
            <div class="col-lg-4 col-md-6">
                <!--Single Feature Area Start-->
                <div class="single-feature-area mb-30">
                    <div class="feature-content">
                        <h3>24 / 7 Technical Support</h3>
                    </div>
                </div>
                <!--Single Feature Area End-->
            </div>
            <div class="col-lg-4 col-md-6">
                <!--Single Feature Area Start-->
                <div class="single-feature-area mb-30">
                    <div class="feature-content">
                        <h3>Multiple credit options</h3>
                    </div>
                </div>
                <!--Single Feature Area End-->
            </div>
        </div>
    </div>
</div>
<!--Feature Area End-->


<!--Deal Product Area Start-->
<div class="deal-product-area deal-bg">
    <div class="deal-produt-slider owl-carousel">
        @foreach ($deal_product as $product)
          <!--Single Deal Product Start-->
          <div class="single-deal-product">
              <div class="deal-product-img img-full py-5">
                  <a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}"><img src="{{ asset('imgs/products/' . $product->pimage) }}" alt="product image"></a>
                  <span class="descount-sticker">-{{ $product->discount }}%</span>
              </div>
              <div class="deal-product-content">
                  <div class="section-title">
                      <span class="sub-title">Our Collections</span>
                  </div>
                  <h3><a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}">{{$product->ptitle}}</a></h3>
                  <p class="product-description">{{$product->particle}}</p>
                  <div class="product-price deal-price">
                          <span class="now-price">${{ $product->price }}</span>
                          <span class="regular-price">${{ (( $product->price * ($product->discount + 100) ) / 100) }}</span>
                      </div>
                      <div class="product-countdown">
                         <div class="pro-countdown" data-countdown="2020/0{{ rand(1,9) }}/04"></div>
                      </div>
              </div>
          </div>
          <!--Single Deal Product End-->
        @endforeach
    </div>
</div>
<!--Deal Product Area End-->


<!--List Product Area Start-->
<div class="list-product-area pt-80 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <!--List Product Section Title Start-->
                            <div class="list-product-section-title mb-30">
                                <h2>New Arrivals</h2>
                            </div>
                            <!--List Product Section Title End-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="list-product-slider owl-carousel">
                            <div class="list-slider-group">
                                @foreach ($new_arrivals as $product)
                                  <!--Single List Product Start-->
                                      <div class="single-list-product mb-50">
                                          <div class="product-img img-full">
                                              <a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}"><img src="{{ asset('imgs/products/' . $product->pimage) }}" alt="product image"></a>
                                          </div>
                                          <div class="product-content">
                                              <h4><a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}">{{$product->ptitle}}</a></h4>
                                              <div class="product-price">
                                                  <span class="now-price">${{ $product->price }}</span>
                                              </div>
                                              @if (! Cart::get($product->id))
                                                <input data-pid="{{ $product->id }}" type="button" value="Add To Cart" class="add-cart-btn add-to-cart-btn">
                                              @else
                                                <input disabled type="button" value="In Cart" class="add-cart-btn add-to-cart-btn">
                                              @endif
                                          </div>
                                      </div>
                                      <!--Single List Product End-->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <!--List Product Section Title Start-->
                            <div class="list-product-section-title mb-30">
                                <h2>Best Sellers</h2>
                            </div>
                            <!--List Product Section Title End-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="list-product-slider owl-carousel">
                                <div class="list-slider-group">
                                  @foreach ($best_sellers as $product)
                                    <!--Single List Product Start-->
                                        <div class="single-list-product mb-50">
                                            <div class="product-img img-full">
                                                <a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}"><img src="{{ asset('imgs/products/' . $product->pimage) }}" alt="product image"></a>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}">{{$product->ptitle}}</a></h4>
                                                <div class="product-price">
                                                    <span class="now-price">${{ $product->price }}</span>
                                                    <span class="regular-price">${{ ($product->price * 115) / 100 }}</span>
                                                </div>
                                                @if (! Cart::get($product->id))
                                                  <input data-pid="{{ $product->id }}" type="button" value="Add To Cart" class="add-cart-btn add-to-cart-btn">
                                                @else
                                                  <input disabled type="button" value="In Cart" class="add-cart-btn add-to-cart-btn">
                                                @endif
                                            </div>
                                        </div>
                                        <!--Single List Product End-->
                                  @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <!--List Product Section Title Start-->
                            <div class="list-product-section-title mb-30">
                                <h2>Most viewed</h2>
                            </div>
                            <!--List Product Section Title End-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="list-product-slider owl-carousel">
                                <div class="list-slider-group">
                                  @foreach ($most_viewed as $product)
                                    <!--Single List Product Start-->
                                        <div class="single-list-product mb-50">
                                            <div class="product-img img-full">
                                                <a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}"><img src="{{ asset('imgs/products/' . $product->pimage) }}" alt="product image"></a>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{ url('shop/' . $product->curl .'/' . $product->purl) }}">{{$product->ptitle}}</a></h4>
                                                <div class="product-price">
                                                    <span class="now-price">${{ $product->price }}</span>
                                                    <span class="regular-price">${{ ($product->price * 115) / 100 }}</span>
                                                </div>
                                                @if (! Cart::get($product->id))
                                                  <input data-pid="{{ $product->id }}" type="button" value="Add To Cart" class="add-cart-btn add-to-cart-btn">
                                                @else
                                                  <input disabled type="button" value="In Cart" class="add-cart-btn add-to-cart-btn">
                                                @endif
                                            </div>
                                        </div>
                                        <!--Single List Product End-->
                                  @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--List Product Area End-->


<!--Our Collection Area Start-->
<div class="our-collection-area collection-bg pb-75">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--Section Title Start-->
                <div class="section-title">
                    <span class="sub-title">Our Collections</span>
                    <h2>Hot products in this week</h2>
                </div>
                <!--Section Title End-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/yeezy-boost-350-beluga') }}"><img src="{{ asset('imgs/template/home/250-220-1.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
            <div class="col-md-3">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/yeezy-boost-350-black-red') }}"><img src="{{ asset('imgs/template/home/250-220-2.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
            <div class="col-md-6">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/jordan-1-hyper-crimson') }}"><img src="{{ asset('imgs/template/home/550-220-1.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
            <div class="col-md-6">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/jordan-1-off-white-chicago') }}"><img src="{{ asset('imgs/template/home/550-220-2.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
            <div class="col-md-3">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/yeezy-boost-700-tephra') }}"><img src="{{ asset('imgs/template/home/250-220-3.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
            <div class="col-md-3">
                <!--Single Categorie Collection Start-->
                <div class="single-categorie-collection mt-30">
                    <div class="categorie-collection-img">
                        <a href="{{ url('shop/sneakers/yeezy-boost-700-wave') }}"><img src="{{ asset('imgs/template/home/250-220-4.jpg') }}" alt="sneaker image"></a>
                    </div>
                </div>
                <!--Single Categorie Collection End-->
            </div>
        </div>
    </div>
</div>
<!--Our Collection Area End-->

@endsection

@extends('layouts.app')

@section('extraJS')
  <script>

  const colorRegex = /^color\[(\d+)?\]$/;
  const brandRegex = /^brand\[(\d+)?\]$/;

  $(function() {
    $('.match-blat').matchHeight();
  });

  // sortBy filter
  $('select#sortBy').change(function (e) {
    let urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sortBy',e.target.value);
    urlParams.delete('page');
    window.location = `{{ URL::current() }}?${urlParams.toString()}`;
  });
  // sortBy filter END

  // brand filter
  $('#brand_filters input:checkbox').on('input',function (e) {
    let urlParams = new URLSearchParams(window.location.search);
    (! urlParams.get('brand[]')) ? urlParams.set('brand[]',e.target.name) : urlParams.append('brand[]',e.target.name);
    urlParams.delete('page');
    urlParams.delete('search');
    window.location = `{{ URL::current() }}?${urlParams.toString()}`;
  });

  $('#brand_filters input:checkbox:checked').on('input',function (e) {
    let urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('page');
    urlParams.delete('search');
    let newColors = [];
    let newBrands = [];

    urlParams.forEach((val,key) => {
      if (brandRegex.test(key)) {
        if (val !== e.target.name) {
          newBrands.push(val);
        }
      } else if (colorRegex.test(key)) {
        newColors.push(val);
      }
    });

    let newUrl = new URLSearchParams();

    newColors.forEach((color) => {
      newUrl.append('color[]',color);
    });

    newBrands.forEach((brand) => {
      newUrl.append('brand[]',brand);
    });

    window.location = (newUrl.toString()) ? `{{ URL::current() }}?${newUrl.toString()}` : `{{ URL::current() }}`;
  });
  // brand filter END

  // color filter
  $('#colors_filter button').on('click',function () {
    let urlParams = new URLSearchParams(window.location.search);
    (! urlParams.get('color[]')) ? urlParams.set('color[]',$(this).data('clr')) : urlParams.append('color[]',$(this).data('clr'));
    urlParams.delete('page');
    urlParams.delete('search');
    window.location = `{{ URL::current() }}?${urlParams.toString()}`;
  });

  $('#colors_chosen button').on('click',function () {
    let urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('page');
    urlParams.delete('search');
    let newColors = [];
    let newBrands = [];

    urlParams.forEach((val,key) => {
      if (colorRegex.test(key)) {
        if (val !== $(this).data('clr')) {
          newColors.push(val);
        }
      } else if (brandRegex.test(key)) {
        newBrands.push(val);
      }
    });

    let newUrl = new URLSearchParams();

    newColors.forEach((color) => {
      newUrl.append('color[]',color);
    });

    newBrands.forEach((brand) => {
      newUrl.append('brand[]',brand);
    });

    window.location = (newUrl.toString()) ? `{{ URL::current() }}?${newUrl.toString()}` : `{{ URL::current() }}`;
  });
  // color filter END


  </script>
@endsection

@section('extraCSS')

  <style media="screen">

    .product-action > ul > li > input.add-to-on {
      font-family:FontAwesome;
      font-size:2em;
      border-radius: 50%;
      text-align: center;
      padding: 5px 15px 45px 12px;
    }

    div.categori-checkbox ul li.active a {
      color: var(--brandMain) !important;
      font-weight: bold !important;
    }

    form#brand_filters input,
    form#brand_filters label{
      cursor: pointer;
    }

    li.color_filter_li{
      clear: none;
      float: left;
      height: 2.5rem;
      list-style-type: none;
      margin-bottom: 1rem;
      margin-right: 1rem;
      width: 2.5rem;
      padding: 5px;
    }

    li.color_filter_li button{
      border: 1px solid black;
      display: block;
      height: 100%;
      width: 100%;
      cursor: pointer;
    }

    li.color_filter_li button:hover{
      transform: scale(1.1);
    }

    .bg-gradient-multi{
      background: linear-gradient(150deg, rgba(180,58,58,1) 0%, rgba(253,179,29,1) 16%, rgba(234,253,39,1) 32%, rgba(45,238,83,1) 45%, rgba(80,161,226,1) 56%, rgba(141,135,176,1) 70%, rgba(173,133,185,1) 82%, rgba(213,155,127,1) 91%, rgba(213,127,202,1) 91%, rgba(252,69,69,1) 100%);
    }
  </style>

@endsection

@section('content')

  <div class="breadcrumb-area pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="breadcrumb-bg py-5">
                <h1 class="display-4">Shop {{ $page_header }}</h1>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-12 mt-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('shop') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_header }}</li>
              </ol>
            </nav>
          </div>
        </div>

        @if (Request::has('search') && $products->total())
          <div class="row">
            <div class="col-12 mt-5">
              <div class="alert alert-warning" role="alert">
                <span class="h5 text-dark align-middle">You searched for: "{{Request::get('search')}}" , showing {{ $products->count() }} out of {{$products->total()}} results.</span>
              </div>
            </div>
          </div>
        @endif

    </div>
  </div>


<!--Shop Area Start-->
<div class="shop-area pb-35 mt-5">
    <div class="container">
       <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
              <!--Product Category Widget Start-->
              <div class="shop-sidebar">
                  <h4>Product Categories</h4>
                  <div class="categori-checkbox">
                    <ul>
                        <li class="{{ strtolower($category) == 'all' ? 'active' : '' }}">
                          <a href="{{ url('shop/all') }}">All ({{ $product_count }})</a>
                        </li>
                        @foreach ($categories as $key => $val)
                          <li class="{{ strtolower($category) == $val['curl'] ? 'active' : '' }}">
                            <a href="{{ url('shop/' . $val['curl']) }}"> {{$key}} ({{ $val['count'] }})</a>
                          </li>
                        @endforeach
                    </ul>
                  </div>
              </div>
              <!--Product Category Widget End-->
                <!-- Widget Start-->
                <div class="shop-sidebar">
                    <h4>Filter by Brand</h4>
                    <div class="categori-checkbox">
                        <form id="brand_filters">
                            <ul>
                              @if (! empty($brand_arr))
                                @foreach ($brand_arr as $name => $brand)
                                  <li>
                                      <div>
                                        <input name="{{ $name }}" id="{{ $name }}-brand" type="checkbox" {{ (in_array($name, $brand_checked)) ? 'checked' : '' }}>
                                        <label for="{{ $name }}-brand">{{ $name }} ({{ count($brand) }})</label>
                                      </div>
                                  </li>
                                  @endforeach
                              @endif
                            </ul>
                        </form>
                    </div>
                </div>
                <!-- Widget End-->
                <!--Color Category Widget Start-->
                <div class="shop-sidebar">
                    <h4>Filter by Color</h4>
                    <div class="categori-checkbox">
                        <ul id="colors_filter">
                          @if (! empty($colors_arr))
                            @foreach ($colors_arr as $color)
                              @if (! in_array($color,$color_checked))
                                @if ($color == 'multi')
                                  <li class="color_filter_li">
                                    <button type="button" data-clr="{{$color}}" class="bg-gradient-multi"></button>
                                  </li>
                                @else
                                  <li class="color_filter_li">
                                    <button type="button" data-clr="{{$color}}" style="background-color:{{ $color }}"></button>
                                  </li>
                                @endif
                              @endif
                              @endforeach
                          @endif
                        </ul>
                    </div>
                </div>
                @if ($color_checked)
                  <div class="shop-sidebar">
                    <h4>Colors chosen:</h4>
                    <div class="categori-checkbox">
                      <ul id="colors_chosen">
                        @foreach ($color_checked as $color)
                            @if ($color == 'multi')
                              <li class="color_filter_li">
                                <button type="button" data-clr="{{$color}}" class="bg-gradient-multi color_checked"><i class="fas fa-times"></i></button>
                              </li>
                            @else
                              <li class="color_filter_li">
                                <button type="button" data-clr="{{$color}}" style="background-color:{{ $color }}" class="color_checked"><i class="fas fa-times"></i></button>
                              </li>
                            @endif
                          @endforeach
                      </ul>
                    </div>
                  </div>
                @endif
                <!--Color Category Widget End-->
                <!--Banner Widget Start-->
                <div class="shop-sidebar">
                        <div class="indecor-single-banner">
                            <div class="single-banner-image img-full">
                                <a href="https://www.google.co.il" target="_blank"><img src="{{ asset('imgs/banners/ad-270-470.png') }}" alt="advertisment"></a>
                            </div>
                        </div>
                </div>
                <!--Banner Widget End-->
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="shop-layout">
                    <!--Grid & List View Start-->
                    <div class="shop-topbar-wrapper d-md-flex justify-content-md-between align-items-center">
                         <!--Toolbar Short Area Start-->
                         <div class="toolbar-short-area d-md-flex align-items-center ml-auto">
                                 <div class="toolbar-shorter ">
                                    <label>Sort By:</label>
                                     <select class="wide" style="display: none;" id="sortBy">
                                         <option data-display="Select">Nothing</option>
                                         <option value="Name A to Z">Name A to Z</option>
                                         <option value="Name Z to A">Name Z to A</option>
                                         <option value="Price low to high">Price low to high</option>
                                         <option value="Price high to low">Price high to low</option>
                                     </select>
                                     <div class="nice-select wide" tabindex="0">
                                       <span class="current">{{ $sortBy }}</span>
                                       <ul class="list" style="z-index: 9999999">
                                         <li data-value="Nothing" data-display="Select" class="option selected">Nothing</li>
                                         <li data-value="Name A to Z" class="option">Name A to Z</li>
                                         <li data-value="Name Z to A" class="option">Name Z to A</li>
                                         <li data-value="Price low to high" class="option">Price low to high</li>
                                         <li data-value="Price high to low" class="option">Price high to low</li>
                                       </ul>
                                     </div>
                                 </div>
                                 <p class="show-product">Showing {{ $products->count() }} of {{ $products->total() }} results</p>
                             </div>
                         <!--Toolbar Short Area End-->
                    </div>
                    <!--Grid & List View End-->
                    @if ($products->total())
                      <!--Shop Product Start-->
                      <div class="shop-product">
                          <div id="myTabContent-2" class="tab-content">
                              <div id="grid" class="tab-pane fade show active">
                                  <div class="product-grid-view">
                                      <div class="row">

                                        @foreach($products as $product)
                                        <!--Single Product Area Start-->
                                        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6">
                                          @if(! Cart::get($product->id))
                                          <div class="single-product-area mb-40">
                                          @else
                                          <div class="single-product-area mb-40" style="opacity:0.6">
                                          @endif
                                              <div class="product-img img-full match-blat">
                                                  <a href="{{ url('shop/' . $product->curl . '/' . $product->purl) }}">
                                                      <img class="first-img" src="{{ asset('imgs/products/'. $product->pimage) }}" alt="product image">
                                                  </a>
                                                  @if(! Cart::get($product->id))
                                                  <div class="product-action">
                                                  @else
                                                  <div class="product-action" style="visibility:visible; opacity:1">
                                                  @endif
                                                      <ul>
                                                          <li>
                                                            @if(! Cart::get($product->id))
                                                              <input data-pid="{{ $product->id }}" type="button" value="&#xf217;" class="btn btn-dark add-to-cart-btn add-to-on">
                                                            @else
                                                              <input disabled type="button" value="In Cart" class="btn btn-dark add-to-cart-btn">
                                                            @endif
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <div class="product-content">
                                                  <h4><a href="{{ url('shop/' . $product->curl . '/' . $product->purl) }}">{{ $product->ptitle }}</a></h4>
                                                  <div class="product-price">
                                                      <span class="now-price">${{ $product->price }}.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                        <!--Single Product Area End-->
                                        @endforeach

                                      </div>
                                  </div>
                              </div>
                              <!--Pagination Start-->
                              <div class="product-pagination">
                                  {{ $products->links() }}
                              </div>
                              <!--Pagination End-->
                          </div>
                      </div>
                      <!--Shop Product End-->
                    @else
                      @if (Request::has('search'))
                        <div class="alert alert-warning text-center py-4" role="alert">
                          <h3 class="alert-heading">No products matching your search</h3>
                          <p class="h6 pt-3">You searched for: "{{Request::get('search')}}"</p>
                          <a class="sidebar-trigger-search btn btn-dark mt-3" role="button" tabindex="0">Search Again <span class="icon_search"></span></a>
                        </div>
                      @else
                        <div class="alert alert-warning text-center py-4" role="alert">
                          <h3 class="alert-heading">No products matching your filters</h3>
                          <a class="sidebar-trigger-search btn btn-dark mt-4" role="button" tabindex="0">Try Searching <span class="icon_search"></span></a>
                        </div>
                      @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop Area End-->

@endsection

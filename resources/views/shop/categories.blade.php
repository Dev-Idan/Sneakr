@extends('layouts.app')

@section('extraCSS')
  <style>
    .h1-logo{
      font-weight: 500;
    }
  </style>
@endsection

@section('content')


	    <div class="container-fluid p-0 mb-5">

        <div class="breadcrumb-area pb-50">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                    <div class="breadcrumb-bg">
                      <h1 class="display-3">Welcome to <span class="main-brand-color h1-logo">Sneak<span class="text-dark">r</span></span> Shop</h1>
		                </div>
                  </div>
              </div>
          </div>
        </div>

        <hr>

        <h2 class="display-4 text-center my-4">Choose Product Category</h2>


        <div class="banner-area">
	        <div class="row py-3">
            @foreach($categories as $category)
              <div class="col-md-4">
                <h3 class="text-center mt-5">{{ $category['ctitle'] }}</h3>
                  <!--Single Banner Image Start-->
                  <div class="single-banner-image mt-30 single-margin">
                      <a href="{{ url('shop/' . $category['curl']) }}"><img src="{{ asset('imgs/categories/' . $category['cimage']) }}" alt="{{ $category['ctitle'] }} category image"></a>
                  </div>
                  <!--Single Banner Image End-->
              </div>
            @endforeach
	        </div>
        </div>
	    </div>



@endsection

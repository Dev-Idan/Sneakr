@extends('layouts.app')

@section('extraCSS')
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

  <style media="screen">

    main{
      font-family: 'Oswald', sans-serif;
      font-weight: 300;
    }
    
    p{
      font-size: 1.3em;
    }

  </style>

@endsection

@section('content')

  <div class="container">
    <div class="row">
      @foreach ($contents as $content)
        <div class="col-12 mt-5">
          <h2 class="display-4 mb-4">{{ $content->ctitle }}</h2>
          <p>{!! $content->carticle !!}</p>
        </div>
      @endforeach
    </div>
  </div>
@endsection

@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Viewing Message "{{$message['m_title']}}"</h1>
  </div>

  <div class="row">
    <div class="col-6 mx-auto mt-4">

      <!-- Message -->
        <div class="card shadow-sm">
          <!-- Header -->
          <div class="card-header py-4 h6 d-flex justify-content-between align-items-center">
            <span class="text-secondary"><span class="text-info">Name:</span> {{ $message['name'] }}</span>
            <span class="text-secondary"><span class="text-info">Email:</span> {{ $message['email'] }}</span>
          </div>
          <!-- Header End -->
          <!-- Body -->
          <div class="card-body bg-light d-flex flex-column">
            <h4 class="mb-4 h4"><span class="text-info">Title:</span> {{ $message['m_title'] }}</h4>
            <p class="text-justify">{!! nl2br(e($message['m_body'])) !!}</p>
          </div>
          <!-- Body End -->
          <!-- Footer -->
          <div class="card-footer text-muted">
              <span class="float-right">{{ date('H:i - d/m/Y', strtotime($message['created_at'])) }}</span>
          </div>
          <!-- Footer End -->
        </div>
        <!-- Message End -->

        <p>
          <a href="{{ url('cms/messages') }}" class="btn btn-lg btn-block btn-info"><span class="arrow_back"></span> Back to messages</a>
        </p>

    </div>
  </div>

@endsection

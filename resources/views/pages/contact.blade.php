@extends('layouts.app')

@section('extraJS')

  <script>

  $('button.btn-refresh').on('click',function () {
    $.get('{{ url('get-captcha') }}' , function (data) {
      $('#captcha-img').html(data);
    });
  });

  </script>

@endsection

@section('content')

  <!--Breadcrumb Area Start-->
  <div class="breadcrumb-area pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="breadcrumb-bg py-5">
                <h1 class="display-3">Contact us</h1>
              </div>
            </div>
        </div>
    </div>
  </div>
  <!--Breadcrumb Area End-->

    <!--Contact Us Area Start-->
    <div class="contact-us-area pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="store-information">
                        <div class="store-title">
                            <h4>Store information</h4>
                            <div class="communication-info">
                                    <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>Sneakr - Silicone Valley <br>Dimona,Israel</span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                                    <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>Call us: <br><a href="tel:8001234567">(+972) 123 4567</a></span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                                    <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>Email us: <br><a href="mailto:demo@sneakr.com">demo@sneakr.com</a></span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="content-wrapper">
                      @if (! Session::has('m_sent'))
                        <div class="page-content">
                            <div class="contact-form">
                                    <div class="contact-form-title">
                                        <h3>Contact us</h3>
                                    </div>
                                <form action="" method="POST" autocomplete="off" novalidate>
                                  @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                          <div class="contact-form-style mb-20">
                                            <input id="name" name="name" placeholder="Full Name" type="text" value="{{ old('name')}}">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="contact-form-style mb-20">
                                            <input id="email" name="email" placeholder="Email Address" type="email" value="{{ old('email')}}">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="contact-form-style mb-20">
                                            <input id="subject" name="subject" placeholder="Subject" type="text" value="{{ old('subject')}}">
                                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="contact-form-style">
                                            <textarea id="message" name="message" placeholder="Message">{{ old('message')}}</textarea>
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="contact-form-style mb-20 d-flex flex-column align-items-start justify-content-between">
                                            <p class="mb-2" id="captcha-img">{!! captcha_img('flat') !!}</p>
                                            <button type="button" class="btn btn-warning btn-refresh mb-3"><i class="fas fa-sync-alt"></i></button>
                                            <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha">
                                            <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="contact-form-style">
                                            <button id="submit" name="submit" class="default-btn" type="submit"><span>SEND MESSAGE</span></button>
                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          </div>
                          @else
                            <div class="row text-center">
                              <div class="col-12">
                                <div class="alert alert-success py-5" role="alert">
                                  <h4 class="alert-heading display-3 mb-5">Thank you!</h4>
                                  <p style="font-size:1.2em">Aww yeah, your message was sent successfully! <br> You will receive our answer back to your email within 3-5 business day.</p>
                                  <a href="{{ url('') }}" class="btn btn-lg btn-secondary mt-5"><span class="arrow_back"></span> Back to Home Page</a>
                                </div>
                              </div>
                            </div>
                          @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact Us Area End-->


@endsection

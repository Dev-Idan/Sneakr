@extends('layouts.app')

@section('extraCSS')

  <style media="screen">

  .testimonial-thing{
    height: 100px;
    border-radius: 50px;
  }

  </style>

@endsection

@section('content')

  <!--Breadcrumb Area Start-->
  <div class="breadcrumb-area pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="breadcrumb-bg py-5">
                <h1 class="display-3">About <span class="main-brand-color">Sneak</span>r</h1>
              </div>
            </div>
        </div>
    </div>
  </div>
  <!--Breadcrumb Area End-->
  <!--About Us Area Start-->
      <div class="about-us-area pb-50">
          <div class="container">
              <div class="row mt-3">
                  <div class="col-lg-6 col-12">
                      <!--About Us Image Start-->
                      <div class="about-us-img-wrapper mb-30">
                          <div class="about-us-image img-full">
                            <img src="{{ asset('imgs/template/about/shop.png') }}" alt="">
                          </div>
                      </div>
                      <!--About Us Image End-->
                  </div>
                  <div class="col-lg-6 col-12">
                      <!--About Us Content Start-->
                      <div class="about-us-content">
                          <h2 class="pb-3">Our company</h2>
                          <p class="mb-20">Sneakr was established 1765 to help young gentlemens cop shoes for their everyday life. The owner and Founder of Sneakr, Idan Hakim, was born in 1750 and is still alive today, maintaining this website and editing CSS. In fact
                          you will be surprised to know that he wrote this paragraph all by himself, even though he really just wanted to paste lorem150 here..</p>

                          <p class="mb-20">Even though the company was founded almost 300 years ago, in 2019 Idan decided that he should build a website for Sneakr, to allow people the option to order their favorite outfits online.</p>

                          <p>We are very proud to announce that Sneakr was built using Laravel and we hope that you enjoy our website half as much as we enjoyed building it. What are you waiting for ?</p>

                          <a href="{{ url('contact') }}" class="default-btn">contact us</a>
                      </div>
                      <!--About Us Content End-->
                  </div>
              </div>
          </div>
      </div>
      <!--About Us Area End-->
      <!--About Us Team Start-->
      <div class="about-us-team-area pb-50">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="team-title mb-50">
                          <h3 class="about-title">our exclusive team</h3>
                          <p>A Rare oppertunity to meet the best of the best in the industry.</p>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <!--Single Team Start-->
                      <div class="single-team mb-30">
                          <div class="team-image img-full">
                            <img src="{{ asset('imgs/template/about/staff1.png') }}" alt="">
                          </div>
                          <div class="team-content">
                              <div class="team-hover-info">
                                  <h2>Idan Hakim</h2>
                                  <ul class="team-social">
                                      <li><a target="_blank" href="https://twitter.com/RadFishTV"><i class="ion-social-twitter"></i></a></li>
                                      <li><a target="_blank" href="https://www.instagram.com/idan.hakim/"><i class="ion-social-instagram"></i></a></li>
                                      <li><a target="_blank" href="https://www.facebook.com/YouGotPB"><i class="ion-social-facebook"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!--Single Team End-->
                  </div>
                  <div class="col-md-4">
                      <!--Single Team Start-->
                      <div class="single-team mb-30">
                          <div class="team-image img-full">
                            <img src="{{ asset('imgs/template/about/staff2.png') }}" alt="">
                          </div>
                          <div class="team-content">
                              <div class="team-hover-info">
                                  <h2>Hakim Idan</h2>
                                  <ul class="team-social">
                                      <li><a target="_blank" href="https://twitter.com/RadFishTV"><i class="ion-social-twitter"></i></a></li>
                                      <li><a target="_blank" href="https://www.instagram.com/idan.hakim/"><i class="ion-social-instagram"></i></a></li>
                                      <li><a target="_blank" href="https://www.facebook.com/YouGotPB"><i class="ion-social-facebook"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!--Single Team End-->
                  </div>
                  <div class="col-md-4">
                      <!--Single Team Start-->
                      <div class="single-team mb-30">
                          <div class="team-image img-full">
                            <img src="{{ asset('imgs/template/about/staff3.png') }}" alt="">
                          </div>
                          <div class="team-content">
                              <div class="team-hover-info">
                                  <h2>Sneakr Mojo</h2>
                                  <ul class="team-social">
                                      <li><a target="_blank" href="https://twitter.com/RadFishTV"><i class="ion-social-twitter"></i></a></li>
                                      <li><a target="_blank" href="https://www.instagram.com/idan.hakim/"><i class="ion-social-instagram"></i></a></li>
                                      <li><a target="_blank" href="https://www.facebook.com/YouGotPB"><i class="ion-social-facebook"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!--Single Team End-->
                  </div>
              </div>
          </div>
      </div>
      <!--About Us Team End-->
      <!--Testimonial Area Start-->
  <div class="testimonial-area testimonial-bg pt-75 pb-75 mb-80">
      <div class="container">
          <div class="row">
              <div class="testimonial-slider owl-carousel">
                  <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('imgs/template/about/testimonial.png') }}" class="testimonial-thing" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc">  This website changed my life from one end to the other. Ever since I started ordering
                            my shoes from here, all my life problem went away. I would like to thank the website's staff personally from the
                            bottom of my heart.</p>
                            <p class="testimonial-author">Troll Master 69</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--Testimonial Area End-->

@endsection

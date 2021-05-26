@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

<!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="caption">
              <span class="checked fw-600 text-size-2rem">FAB</span><span class="text-size-2rem">RIQUE</span>
              <div class="line-dec"></div>
              <p>
                {{ env('APP_NAME') }} is a Fictional Ecommerce Website. The purpose of this app 
                is to showcase the skills of what I am capable of. Please do not try 
                any real transactions here. Mostly the features of an ecommerce site is implemented in this app, only for showing
                my skills and for my Portfolio.
                <br><br>
                If you want to get in touch with me, please contact me with my email: <span class="checked">mrmirasrobert@gmail.com</span><br>
              </p>
              <div class="main-button">
                <a href="#">
                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  Shop Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <!-- Featured Starts Here -->
    <div class="featured-items">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Featured Items</h1>
              <div class="ml-auto">
                <a href="{{ route('product.view') }}">View all products <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-3">

            <x-home-product :products="$products" />

          </div>
        </div>
      </div>
    </div>
    <!-- Featred Ends Here -->

    <!-- Subscribe Form Starts Here -->
    <div class="subscribe-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Subscribe on {{ env('APP_NAME') }} now!</h1>
            </div>
          </div>
          <div class="col-md-8 offset-md-2">
            <div class="main-content">
              <p>
                Integer vel turpis ultricies, lacinia ligula id, lobortis augue.
                Vivamus porttitor dui id dictum efficitur. Phasellus vel
                interdum elit.
              </p>
              <div class="container">
                <form id="subscribe" action="" method="get">
                  <div class="row">
                    <div class="col-md-7">
                      <fieldset>
                        <input
                          name="email"
                          type="text"
                          class="form-control"
                          id="email"
                          onfocus="if(this.value == 'Your Email...') { this.value = ''; }"
                          onBlur="if(this.value == '') { this.value = 'Your Email...';}"
                          value="Your Email..."
                          required=""
                        />
                      </fieldset>
                    </div>
                    <div class="col-md-5">
                      <fieldset>
                        <button type="submit" id="form-submit" class="button">
                          Subscribe Now!
                        </button>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Subscribe Form Ends Here -->
@endsection
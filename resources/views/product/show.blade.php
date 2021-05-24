@extends('layouts.app')

@section('title')
  {{ $product->name }}
@endsection

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('assets/css/flex-slider.css') }}" />
@endsection

@section('content')

   <!-- Page Content -->
    <!-- Single Starts Here -->
    <div class="single-product">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              
              @if( session('status') )
              <div class="alert alert-success alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('status')  }}  
              </div>
              @endif

              @if( session('error') )
              <div class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('error')  }}  
              </div>
              @endif

              <div class="line-dec"></div>
              <h1>{{ $product->name }}</h1>
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-slider">
              <div id="slider" class="flexslider">
                <ul class="slides">
                  <li> 
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <!-- items mirrored twice, total of 12 -->
                </ul>
              </div>
              <div id="carousel" class="flexslider">
                <ul class="slides">
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <li>
                    <img src="/storage/{{ $product->image }}" />
                  </li>
                  <!-- items mirrored twice, total of 12 -->
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">

              <h4>{{ $product->name }}</h4>
              
              <h6>${{ $product->price }}.00</h6>

              <p>
                {{ $product->description }}
              </p>

              <span class="{{ ($product->qty < 1) ? 'text-danger' : "" }}">
                {{ ($product->qty > 0) ? $product->qty. ' left on stock' : "Out Of Stock" }}
              </span>

              <div id="rate-avg">
                @if($rateAverage != 0)
                  <span class="m-0 p-0">{{ $rateAverage }}</span>
                  <span>
                    @for ($i = 0; $i < intval($rateAverage); $i++)
                    <i class="fa fa-star checked pt-1"></i>
                    @endfor
                  </span>
                @else
                  <span class="m-0 p-0">No ratings |</span>
                  <span>
                    @for ($i = 0; $i < 5; $i++)
                    <i class="fa fa-star gray pt-1"></i>
                    @endfor
                  </span>
                @endif
              </div>
            
              <form action="/mycart/{{ $product->id }}" method="POST">
                @csrf
                <label for="quantity">Quantity:</label>
                <input
                  name="product_qty"
                  type="number"
                  min="1"
                  class="quantity-text @error('product_qty') border border-danger @enderror" value="{{ old('product_qty') ?? 1 }}"
                  id="quantity"
                  onfocus="if(this.value == '1') { this.value = ''; }"
                  onBlur="if(this.value == '') { this.value = '1';}"
                  value="1"
                  required
                  {{ ($product->qty < 1) ? "disabled" : "" }}
                />

                @error('product_qty')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror

                <button type="submit" class="btn {{ ($product->qty < 1) ? "btn-danger" : "btn-primary" }}" {{ ($product->qty < 1) ? "disabled" : "" }}>Add To Cart</button>
              </form>

              <div class="down-content">
                <div class="categories">
                  <h6>
                    Brand:
                    <span>
                      <a href="#">
                        {{ $product->brand }}
                      </a>
                      </span>
                  </h6>
                </div>
                <div class="share">
                  <h6>
                    Share:
                    <span
                      ><a href="https://www.facebook.com/MirasRobert"><i class="fa fa-facebook"></i></a
                      ><a href="https://www.linkedin.com/in/robert-miras/"><i class="fa fa-linkedin"></i></a
                      ><a href="https://github.com/mirasrobert"><i class="fa fa-github"></i></a
                    ></span>
                  </h6>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Single Page Ends Here -->

    {{-- Comment/Review Section --}}
    <section id="comment" class="mt-5">
      <div class="container">
          <div class="row">
              <div class="col-lg-7">
                  <div class="card card-outline-secondary my-4">
                      <div class="card-header">
                        Product Reviews | 
                        <span class="text-mute">
                          {{ $product->reviews->count() }} review(s)
                        </span>
                      </div>
                      
                      {{-- MAIN BODY --}}

                      <x-product-review :product="$product" :reviews="$reviews" :hasReview="$hasReview" :canReview="$canReview" />

                      {{-- END OF MAIN BODY --}}

                    </div>
              </div>
          </div>
      </div>
    </section>

@endsection

@section('extra-js')
<script src="{{ asset('js/cartqty.js') }}"></script>
@endsection
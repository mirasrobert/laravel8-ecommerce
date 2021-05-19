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
                Proin commodo, diam a ultricies sagittis, erat odio rhoncus
                metus, eu feugiat lorem lacus aliquet arcu. Curabitur in gravida
                nisi, non placerat nibh. Praesent sit amet diam ultrices,
                commodo turpis id, dignissim leo. Suspendisse mauris massa,
                porttitor non fermentum vel, ullamcorper scelerisque velit.
              </p>

              <span class="{{ ($product->qty < 1) ? 'text-danger' : "" }}">
                {{ ($product->qty > 0) ? $product->qty. ' left on stock' : "Out Of Stock" }}
              </span>

              <div id="rate-avg">
                <span class="m-0 p-0">{{ $rateAverage }}</span>
                <span>
                  @for ($i = 0; $i < intval( $rateAverage); $i++)
                  <i class="fa fa-star checked pt-1"></i>
                @endfor
                </span>
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
                      <div class="card-body">
                        
                        {{-- PRODUCT REVIEWS --}}
                        @if ($product->reviews->count() != 0)
                          @foreach ($reviews as $key => $review)
                          <div id="product-reviews">
                            <p class="text-dark">{{ $review->comment }}</p>
                            <small class="text-muted">Posted by {{ $review->name }} on {{ $review->created_at }}</small>
                            <div class="reviews d-flex justify-content-start">
                            @for ($i = 0; $i < $review->rate; $i++)
                             <i class="fa fa-star checked pt-1"></i>
                            @endfor
                            <span class="ps-2 text-muted">  | <small>{{ $review->rate }} Stars</small> </span>
                          </div>
                          <hr>
                          </div>
                          @endforeach
                        @else
                          <div class="alert alert-info alert-dismissible mt-3">
                            <small>
                              This product has no reviews.
                              Let others know what do you think and be the first to write a review.
                            </small>
                            <img width="35" height="35" src="https://laz-img-cdn.alicdn.com/tfs/TB1cXF1llTH8KJjy0FiXXcRsXXa-112-98.png" alt="sad-face">
                          </div>
                        @endif

                        {{-- PAGINATION BUTTONS --}}
                        <div class="row ml-1">
                          {{ $reviews->links('pagination::bootstrap-4') }}
                        </div>

                        <!-- FORM REVIEW -->
                        <div class="row">
                          
                          @guest
                          <!-- Login Info -->
                          <div class="container ps-4 pe-4">
                              <div class="alert alert-info" role="alert">
                              @if (Route::has('login'))
                                Please <a href="{{ route('login') }}" class="alert-link">sign in</a>. to write a review.
                              </div>
                              @endif
                          </div>
                          <!-- End Login Info -->
                          @else
                            <div class="col-lg-7 col-sm-12">

                              {{-- Check if user has review --}}
                              @if ($hasReview)
                                <div class="alert alert-info alert-dismissible mt-3">
                                  You already have a review
                                </div>
                              @else

                                @if ($canReview && Auth::checK())
                                  <h4>Write your Review</h4>
                                  
                                  <form action="{{ route('review.store', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="Rating" class="form-label">Rating</label>
                                        <select class="form-select @error('rating') is-invalid @enderror" name="rating" value="{{ old('rating') }}" aria-label="Rating" autofocus >
                                            <option value="1">1 - Very Bad</option>
                                            <option value="2">2 - Bad</option>
                                            <option value="3">3 - Satisfactory</option>
                                            <option value="4">4 - Good</option>
                                            <option value="5">5 - Satisfactory</option>
                                          </select>
                                    </div>

                                    @error('rating')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror

                                    <div class="mb-3">
                                      <label for="review" class="form-label">Review</label>
                                      <textarea class="form-control @error('review') is-invalid @enderror" name="review" value="{{ old('review') }}" placeholder="Write your review here.." autofocus></textarea>
                                      <small id="emailHelp" class="form-text text-muted">Please share your experience with this product.</small>

                                      @error('review')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                                  @else
                                   
                                    <div class="alert alert-info alert-dismissible mt-3">
                                      <small>Please buy the product to write a review.</small>
                                    </div>

                                @endif
                              @endif

                            </div>
                            @endguest

                        </div>
                        <!-- END OF FORM REVIEW -->
                      </div>
                    </div>
              </div>
          </div>
      </div>
    </section>

@endsection

@section('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/cartqty.js') }}"></script>
{{-- DROPDOWN --}}
<script>
  let dropdownMenu = document.querySelector('.dropdown-menu');
  navbarDropdown.addEventListener('click', function() {
    dropdownMenu.classList.toggle("show");
  })
</script>
@endsection
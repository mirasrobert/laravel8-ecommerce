
@extends('layouts.app')

@section('title')
{{ $product->name }}
@endsection

@section('content')

<div>
    <section id="main-content">
        <div class="container">
        @if( session('status') )
          <div class="alert alert-success alert-dismissible mt-3">
            {{ session('status')  }}    
          </div>
        @endif

        @if( session('error') )
          <div class="alert alert-danger alert-dismissible mt-3">
            {{ session('error')  }}    
          </div>
        @endif

          <div class="row pt-5">
            <div class="col-lg-7 col-sm-12">
              <div class="d-flex">
                  <div class="p-4 align-self-start">
                      <img src="/storage/{{ $product->image }}" class="img-fluid" />
                  </div>
                  <div class="p-4 align-self-end">
  
                  <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                          <!--  Product Title -->
                          <h5>{{ $product->name }}</h5>
                      </li>
                      <li class="list-group-item">
                         <!-- Star Reviews -->
                        <div class="d-flex align-self-start">
                          @if ($product->reviews->count() != 0)
                            @for ($i = 0; $i < intval($rateAverage); $i++)
                            <i class="fas fa-star checked"></i>
                            @endfor
                          @else
                            @for ($i = 0; $i < 5; $i++)
                              <i class="fas fa-star text-muted"></i>
                            @endfor
                          @endif
                          <span class="text-muted ps-1">{{ $rateAverage }} Ratings </span>
                        </div>
                      </li> 
                      <li class="list-group-item">
                         <!-- Product Desc -->
                          <p class="text-dark">
                            Description:
                            <span>
                                {{ $product->description }}
                            </span>
                          </p>
                      </li>
                  </ul>
  
                  </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
              <form action="/mycart/{{ $product->id }}" method="POST">
                @csrf
                <ul class="list-group">
                  <li class="list-group-item">
                      Price 
                      <span class="ps-5 ms-2" id="price">
                        ${{ $product->price }}
                      </span>
                  </li>
                  <li class="list-group-item">
                      Status
                      <span class="ps-4 ms-4 fw-bold {{ ($product->qty > 0) ? "text-primary" : "text-danger" }}">
                        {{ ($product->qty > 0) ? "In Stock" : "Out Of Stock" }}
                      </span>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex">
                          <div class="align-self-start">
                              Qty
                          </div>
                          <div class="align-self-end ps-5 ms-4">
                            <input type="number" name="product_qty" class="form-control  @error('product_qty') border border-danger @enderror" value="{{ old('product_qty') ?? 1 }}" placeholder="" min="1" autofocus required {{ ($product->qty < 1) ? "disabled" : "" }}>
                            
                            @error('product_qty')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-grid gap-2 col-6 mx-auto">
                          <button type="submit" class="btn {{ ($product->qty < 1) ? "btn-danger" : "btn-primary" }} text-uppercase p-2" {{ ($product->qty < 1) ? "disabled" : "" }}>add to cart</button>
                      </div>
                  </li>
                </ul>
              </form>
            </div>
            </div>
          </div>
        </div>
      </section>

      {{-- Comment/Review Section --}}
      <section id="comment">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                          Product Reviews | <span class="text-mute">{{ $product->reviews->count() }} Vote(s)</span>
                        </div>
                        <div class="card-body">
                          
                          {{-- PRODUCT REVIEWS --}}
                          @if ($product->reviews->count() != 0)
                            @foreach ($product->reviews as $key => $review)
                            <div id="product-reviews">
                              <p class="text-dark">{{ $review->comment }}</p>
                              <small class="text-muted">Posted by {{ $review->name }} on {{ $review->created_at }}</small>
                              <div class="reviews d-flex justify-content-start">
                              @for ($i = 0; $i < $review->rate; $i++)
                                <i class="fas fa-star checked"></i>
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

                          {{-- {{ $product->reviews->links('pagination::bootstrap-4') }} --}}

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

</div>
@endsection
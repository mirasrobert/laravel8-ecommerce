<div class="card-body">

    {{-- PRODUCT REVIEWS --}}
    @if ($reviews->count() != 0)
        @foreach ($reviews as $key => $review)
            <div id="product-reviews">
                <p class="text-dark">{{ $review->comment }}</p>
                <small class="text-muted">Posted by {{ $review->name }}
                    on {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</small>
                <div class="reviews d-flex justify-content-start">
                    @for ($i = 0; $i < $review->rate; $i++)
                        <i class="fa fa-star checked pt-1"></i>
                    @endfor
                    <span
                        class="ps-2 text-muted">  | <small>{{ $review->rate }} {{ Str::plural('star', $review->rate) }}</small> </span>
                </div>
                <hr>
            </div>
        @endforeach
    @else
        <div class="alert alert-info alert-dismissible mt-3">
            <div>
                This product has no reviews.
                Let others know what do you think and be the first to write a review.
                <img width="35" height="35"
                     src="https://laz-img-cdn.alicdn.com/tfs/TB1cXF1llTH8KJjy0FiXXcRsXXa-112-98.png"
                     alt="sad-face">
            </div>
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
                                <select class="form-select @error('rating') is-invalid @enderror" name="rating"
                                        value="{{ old('rating') }}" aria-label="Rating">
                                    <option value="1">1 - Horrible</option>
                                    <option value="2">2 - Bad</option>
                                    <option value="3">3 - Good</option>
                                    <option value="4">4 - Satisfactory</option>
                                    <option value="5">5 - Outstanding</option>
                                </select>
                            </div>

                            @error('rating')
                            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                            @enderror

                            <div class="mb-3">
                                <label for="review" class="form-label">Review</label>
                                <textarea class="form-control @error('review') is-invalid @enderror" name="review"
                                          value="{{ old('review') }}" placeholder="Write your review here.."
                                          autofocus></textarea>
                                <small id="emailHelp" class="form-text text-muted">Please share your experience with
                                    this product.</small>

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
                            <div>Please buy the product to write a review.</div>
                        </div>

                    @endif
                @endif

            </div>
        @endguest

    </div>
    <!-- END OF FORM REVIEW -->
</div>

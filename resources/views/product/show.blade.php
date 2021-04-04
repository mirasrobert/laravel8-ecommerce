
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
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <span class="text-muted ps-1">0 reviews</span>
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
                      @if ($product->qty > 0)
                      <span class="ps-4 ms-4">
                        In Stock
                      </span>
                      @else 
                      <span class="ps-4 ms-4">
                        Out of Stock
                      </span>
                      @endif
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex">
                          <div class="align-self-start">
                              Qty
                          </div>
                          <div class="align-self-end ps-5 ms-4">
                            <input type="number" name="product_qty" class="form-control  @error('product_qty') border border-danger @enderror" value="{{ old('product_qty') ?? 1 }}" placeholder="" min="1" autofocus required>
                          </div>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-grid gap-2 col-6 mx-auto">
                          <button type="submit" class="btn btn-primary text-uppercase p-2">add to cart</button>
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
                          Product Reviews
                        </div>
                        <div class="card-body">
                          <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                          <hr>
                          <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                          <hr>
                          <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                          <hr>
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
                                <h4>Write your Review</h4>
                                <form class="">
                                  <div class="mb-3">
                                      <label for="Rating" class="form-label">Rating</label>
                                      <select class="form-select" aria-label="Rating">
                                          <option value="1">1 - Very Bad</option>
                                          <option value="2">2 - Bad</option>
                                          <option value="3">3 - Satisfactory</option>
                                          <option value="4">4 - Good</option>
                                          <option value="5">5 - Satisfactory</option>
                                        </select>
                                  </div>
                                  <div class="mb-3">
                                    <label for="review" class="form-label">Review</label>
                                    <textarea class="form-control" name="review" placeholder="Write your review here.."></textarea>
                                  </div>                    
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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
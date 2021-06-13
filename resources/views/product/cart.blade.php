@extends('layouts.app')

@section('title')
    My Cart
@endsection

@section('content')


  <!-- ========================= SECTION PAGETOP ========================= -->
  <section class="section-pagetop bg mt-5">
    <div class="container">
      <h2 class="title-page">Shopping cart</h2>


      @if( session('status') )
  <div class="alert alert-success alert-dismissible mt-3 mb-3">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('status')  }}  
  </div>
  @endif  

  @if( session('error') )
  <div class="alert alert-danger alert-dismissible mt-3 mb-3">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('error')  }}  
  </div>
  @endif  
 
  {{-- Check If Cart is Empty --}}
  @if (MyCart::count() == 0 )
       <!-- Cart Info -->
  <div class="alert alert-info" style="margin-bottom: 10rem;" role="alert">
    Your cart is empty. <a href="{{ route('home') }}" class="alert-link">Go Back</a>
  </div>

    </div>
  </section>
  <!-- ========================= SECTION INTRO END// ========================= -->
  

  @else <!-- Show Only Pending Products -->
 
  
   <!--Main layout-->
   <main>
    <div class="container">

      <!--Section: Block Content-->
      <section class="mt-5 mb-4">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-lg-8">

            <!-- Card -->
            <div class="card wish-list mb-4">
              <div class="card-body">

                <h5 class="mb-4">Cart (<span>{{ MyCart::count() }}</span> items)</h5>

                
                {{-- START PROdUCT --}}
                @foreach (MyCart::content() as $key => $product)
                <div class="row mb-4">
                  <div class="col-md-5 col-lg-3 col-xl-3">
                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                      <a href="{{ route('product.show', ['product' => $product->id, 'slug' => $product->options->slug]) }}">
                        <img class="img-fluid w-100"
                          src="{{ $product->options->img }}" alt="Sample">
                      </a>
                    </div>
                  </div>
                  <div class="col-md-7 col-lg-9 col-xl-9">
                    <div>

                      <div class="d-flex justify-content-between">

                        <div>
                          @if(strlen($product->name) > 25)
                          <h5 class="prd-name">{{ substr($product->name, 0, 25) }}...</h5>
                          @else 
                          <h5 class="prd-name">{{ $product->name }}</h5>
                          @endif

                          <p class="mb-3 text-muted text-uppercase small">Brand - {{ $product->options->brand }}</p>
                          {{-- <p class="mb-2 text-muted text-uppercase small">Color: blue</p>
                          <p class="mb-3 text-muted text-uppercase small">Size: M</p> --}}
                        </div>

                        <div class="quantity-section">

                          <div class="def-number-input number-input safari_only mb-0 w-100">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                              class="minus" id="minus_{{ $product->rowId }}"></button>

                            <form action="/cart" method="POST">
                            @csrf
                            
                            <input 
                            data-id="{{ $product->rowId }}"
                            class="product_qty quantity @error('product_qty') border border-danger @enderror"
                            type="number"
                            name="product_qty"
                            id="product_qty_{{ $product->rowId }}"
                            min="1"
                            max="15"
                            value="{{ $product->qty }}"
                            />
                            
                            </form>

                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                              class="plus" id="plus_{{ $product->rowId }}"></button>
                          </div>

                          {{-- <small id="passwordHelpBlock" class="form-text text-muted text-center">
                            (Note, 1 piece)
                          </small> --}}

                        </div>

                      </div>

                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                          
                            <button type="submit" class="gray remove-item card-link-secondary small text-uppercase mr-3">
                              <i class="fa fa-trash gray mr-1"></i> Remove item </a>
                            </button>

                             
                          </form>
                          <a href="#!" type="button" class="gray card-link-secondary small text-uppercase"><i
                              class="fa fa-heart gray mr-1"></i> Move to wish list </a>
                        </div>
                        <p class="mb-0 text-black lead"><span><strong>₱{{ $product->price }}</strong></span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
                @endforeach
                {{-- END PRODUCT --}}

                <p class="text-primary mb-0"><i class="fa fa-info-circle mr-1"></i> For now we only accept Paypal and Credit or Debit Card. Thank you for patience.</p>

                  <a href="{{ route('product.view') }}" class="btn btn-light mt-3 float-md-right">
                    <i class="fa fa-chevron-left"></i> Continue shopping
                  </a>

              </div>
            </div>
            <!-- Card -->


          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-4">

            <div class="card mb-3">
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label>Have coupon?</label>
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control"
                        name=""
                        placeholder="Coupon code"
                      />
                      <span class="input-group-append">
                        <button class="btn btn-primary">Apply</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
              <!-- card-body.// -->
            </div>
            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">
                <dl class="dlist-align">
                  <dt>Subtotal:</dt>
                  <dd class="text-right">{{ MyCart::subtotal()}}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Tax(12%):</dt>
                  <dd class="text-right">{{ MyCart::tax()}}</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Total:</dt>
                  <dd class="text-right h5"><strong>₱{{ MyCart::total() }}</strong></dd>
                </dl>
                <hr />
                <p class="text-center mb-3">
                  <img src="img/payment.png" height="26" />
                </p>
                <p class="text-center mx-auto">
                  <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                    Make Purchase <i class="fa fa-chevron-right"></i>
                  </a>
                </p>
                  
              </div>
              <!-- card-body.// -->
            </div>
            <!-- Card -->

            

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Block Content-->

    </div>
  </main>
  <!--Main layout-->

  @endif

 

  

</div>
@endsection

@section('extra-js')
  <script src="{{ asset('js/cartqty.js') }}"></script>
@endsection
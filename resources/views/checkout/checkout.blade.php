@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')

<section id="order">
    <div class="container">
      <div class="row mt-5 py-5">
        <div class="col-lg-8"> 

          @if( session('error') )
          <div class="alert alert-danger" role="alert">
            {{ session('error')  }}    
          </div>
          @endif  

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h3 class="text-uppercase">Shipping</h3>
              <small>{{ auth()->user()->shipping->address }} {{ $selectedProvince->provDesc }} - {{ $selectedCity->citymunDesc }} - {{ $selectedBrgy->brgyDesc }}</small>
              <span> <a href="{{ route('shipping.edit') }}">Edit</a> </span>
            </li>
            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Payment Method</h3>
              <small>Paypal or Debit Card</small>
{{--              <span> <a href="#">Change</a> </span>--}}
            </li>
            {{-- Item --}}
            
            <li class="list-group-item mt-3">
              <h3 class="text-uppercase text-dark">Order Items</h3>

              <ul class="list-group list-group-flush">
                @foreach (MyCart::content() as $key => $product)
                <li class="list-group-item pl-4">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-lg-3 img-container m-0 p-0">
                          <a href="/product/{{ $product->id }}/{{ $product->slug }}">
                            <img
                                    src="storage/{{ $product->options->img }}"
                                    width="150"
                                    height="100"
                            />
                          </a>
                        </div>
                        <div class="col-lg-4 product-name">
                          <p class="text-dark">
                            {{ $product->name }}
                          </p>
                        </div>
                        <div class="col-lg-5">
                          <small class="text-dark">
                            <span>{{ $product->qty }}</span> x
                            <span> &#8369;{{ $product->price }}</span> =
                            <span> &#8369;{{ ($product->qty * $product->price) }}</span>
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach

              </ul>
              
              
            </li>

          </ul>
        </div>
        <!-- Order Summary -->
        <div class="col-lg-4">
          <div class="card mt-2">
            <div class="card-body">

              <h3 class="text-uppercase">Order Summary</h3>
              <hr>
              
              <!-- Subtotal Price -->
              <div class="row py-1">
                <div class="col lg-6">Items:</div>
                <div class="col lg-6">{{ MyCart::instance('default')->count() }}</div>
              </div>

              <!-- Discount-->
              <div class="row py-1">
                <div class="col lg-6">Discount:</div>
                <div class="col lg-6">&#8369; 0.00</div>
              </div>

              <!-- Shipping-->
              <div class="row py-1">
                <div class="col lg-6">Shipping:</div>
                <div class="col lg-6">&#8369; 0.00</div>
               
              </div>

              <!-- Total -->
              <div class="row py-1">
                <div class="col lg-6">Tax (12%):</div>
                <div class="col lg-6">
                  <span>{{ MyCart::tax()}}</span>
                </div>
              </div>

              <!-- Total -->
              <div class="row py-1">
                <div class="col lg-6">Total:</div>
                <div class="col lg-6">
                  <span class="fw-bold">&#8369;{{ MyCart::total() }}</span>
                  <input type="hidden" id="total" value="{{ $total }}">
                </div>
              </div>

              <hr />

              {{-- PAYPAL BUTTON --}}
              <div id="paypal-button-container"></div>

              <div class="d-flex gap-2 col-lg-7 mx-auto">
                <img src="img/payment.png" class="img-fluid" />
              </div>
                              
              </div>

            </div>

            {{-- Payment Details --}}
           {{-- <div class="card mt-3">
              <div class="card-body">
                <h3 class="text-uppercase">Payment</h3>
                <hr>
            --}}    

                {{-- data-cc-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"  --}}

                <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
                  @csrf

                  <div class="form-group">
                    <input type="hidden" name="address" id="address" value="{{ auth()->user()->shipping->address }}"  readonly required>
                    <input type="hidden" name="city" id="city" value="{{ $selectedCity->citymunDesc }}"  readonly required>
                    <input type="hidden" name="province" id="province" value="{{ $selectedProvince->provDesc }}"  readonly required>
                    <input type="hidden" name="brgy" id="brgy" value="{{ $selectedBrgy->brgyDesc }}"  readonly required>
                  </div>

                {{--
                <div class="form-group">
                  <label for="name_on_card" class="col-form-label text-md-right">Name Of Card</label>
                  <input id="name_on_card" type="name_on_card" class="form-control @error('name_on_card') is-invalid @enderror" name="name_on_card" required autocomplete="name_on_card">

                    @error('name_on_card')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  <div id="passwordHelpBlock" class="form-text">
                    Beware of scams.
                  </div>
                </div>
                --}}

                
                {{-- Stripe Form --}}
                {{-- <div class="form-group mt-3">
                  <label for="card-element">
                    Credit or debit card
                  </label>
                  <div id="card-element">
                    <!-- a Stripe Element will be inserted here. -->
                  </div>

                  <!-- Used to display form errors -->
                  <div id="card-errors" role="alert"></div>
              </div> --}}
              {{-- End Stripe Form --}}
              
              {{-- <hr> --}}

              {{--
              <div class="d-grid gap-2">
                <button id="complete-order" class="btn btn-primary text-uppercase p-2" type="submit">Place Order</button>
              </div>
              --}}

            </form>

            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('extra-js')
{{-- PAYPAL SDK API --}}
<script
    src="https://www.paypal.com/sdk/js?client-id={{ $PAYPAL_CLIENT_ID }}&locale=en_PH">
</script>

{{-- PAYPAL INTEGRATION --}}
<script src="{{ asset('js/paypalapi.js') }}"></script>

@endsection

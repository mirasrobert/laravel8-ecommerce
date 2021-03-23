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
      <div class="row py-5">
        <div class="col-lg-8"> 

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h3 class="text-uppercase text-muted">Shipping</h3>
              <h5>{{ auth()->user()->shipping->address }} {{ auth()->user()->shipping->city }} {{ auth()->user()->shipping->province }}, {{ auth()->user()->shipping->country }}</h5>
              
            </li>
            <li class="list-group-item">
              <h3 class="text-uppercase text-muted">Payment Method</h3>
              <h5>Cash on delivery</h5>
            </li>
            {{-- Item --}}
            
            <li class="list-group p-3 pb-0">
              <h3 class="text-uppercase text-muted">Order Items</h3>
            </li>
            
            @foreach (MyCart::content() as $key => $product)
            <li class="list-group-item mt-3">
              <div class="d-flex justify-content-center">
                <div class="row">
                  <div class="row align-items-center">
                    <div class="col-lg-3">
                      <img
                        src="storage/{{ $product->options->img }}"
                        class="img-fluid"
                        width="100rem"
                        height="100rem"
                      />
                    </div>
                    <div class="col-lg-5">
                      <p class="text-dark">
                        {{ $product->name }}
                      </p>
                    </div>
                    <div class="col-lg-4">
                      <p class="text-dark">
                        <span>{{ $product->qty }}</span> x
                        <span>{{ $product->price }}</span> =
                        <span>{{ ($product->qty * $product->price) }}</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>          
            @endforeach

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
                <div class="col lg-6">$ 0.00</div>
              </div>

              <!-- Shipping-->
              <div class="row py-1">
                <div class="col lg-6">Shipping:</div>
                <div class="col lg-6">$ 0.00</div>
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
                  <span class="fw-bold">${{ MyCart::total() }}</span>
                </div>
              </div>

              <hr />
              <div class="d-flex gap-2 col-lg-7 mx-auto">
                <img src="img/payment.png" class="img-fluid" />
              </div>
                              
              </div>

            </div>

            {{-- Payment Details --}}
            <div class="card mt-3">
              <div class="card-body">
                <h3 class="text-uppercase">Payment</h3>
                <hr>

                <form action="{{ route('checkout.store') }}" method="post" id="payment-form" data-cc-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                  @csrf
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

                <div class="form-group">
                  <input type="hidden" name="address" id="address" value="{{ auth()->user()->shipping->address }}"  readonly required>
                  <input type="hidden" name="city" id="city" value="{{ auth()->user()->shipping->city }}"  readonly required>
                  <input type="hidden" name="province" id="province" value="{{ auth()->user()->shipping->province }}"  readonly required>
                  <input type="hidden" name="postalcode" id="postalcode" value="{{ auth()->user()->shipping->postal_code }}"  readonly required>
                </div>
                
                {{-- Stripe Form --}}
                <div class="form-group mt-3">
                  <label for="card-element">
                    Credit or debit card
                  </label>
                  <div id="card-element">
                    <!-- a Stripe Element will be inserted here. -->
                  </div>

                  <!-- Used to display form errors -->
                  <div id="card-errors" role="alert"></div>
              </div>
              {{-- End Stripe Form --}}

              <hr>

              <div class="d-grid gap-2">
                <button id="complete-order" class="btn btn-primary text-uppercase p-2" type="submit">Place Order</button>
              </div>

            </form>

            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('extra-js')
<script>
  // Create a Stripe client.
  var stripe = Stripe('pk_test_51IY0L6JrD7AXIUlSejg5ryIQezY9lqXifT0P1aHE6sKfUXEfT3e6mHO5pJ8L9HjSXsVBNOhTs3swdWCdwGMv0uyW00yDpnSF3J');

  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
      base: {
          color: '#32325d',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
              color: '#aab7c4'
          }
      },
      invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
      }
  };

  // Create an instance of the card Element.
  var card = elements.create('card', {
    style: style,
    hidePostalCode: true //Hide Postal Code in Form
  });

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  // Handle real-time validation errors from the card Element.
  card.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
          displayError.textContent = event.error.message;
      } else {
          displayError.textContent = '';
      }
  });

  // Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
      event.preventDefault(); 

      // Disable the submit button to prevent repeated clicks
      document.getElementById('complete-order').disabled = true;
  
  // Options
  var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }

      stripe.createToken(card, options).then(function(result) {
          if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;

              // If Some Error Occur Enable the button
              // Enable the submit button
              document.getElementById('complete-order').disabled = false;

          } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
          }
      });
  });

  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
  }
</script>
@endsection
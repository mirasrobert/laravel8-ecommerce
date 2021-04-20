@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
<section id="order">
    <div class="container">
      <div class="row py-5">
        <div class="col-lg-8"> 
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Shipping</h3>
              <small>32 A Mabin St Cavinti Laguna, Philippines</small>
            </li>

            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Payment Method</h3>
              <small>Cash on delivery</small>
              <span class="bg-danger rounded-pill p-2 text-white" style="font-size: 0.7rem;">NOT PAID</span>
              <span class="bg-success rounded-pill p-2 text-white" style="font-size: 0.7rem;">PAID</span>
            </li>
            
            <li class="list-group-item mt-3">
              <h3 class="text-uppercase text-dark">Order Items</h3>

              <ul class="list-group list-group-flush">

                @foreach ($orders as $order)
                <li class="list-group-item">
                  <div class="div-row">
                    <div class="row">
                      <div class="row align-items-center">
                        <div class="col-lg-3">
                          <img
                            src="/storage/{{ $order->image }}"
                            class="img-fluid"
                            width="75rem"
                            height="75rem"
                          />
                        </div>
                        <div class="col-lg-4">
                          <small class="text-dark">
                            {{ $order->name }}
                          </small>
                        </div>
                        <div class="col-lg-5">
                          <small class="text-dark">
                            <span>{{ $order->pivot->qty }}</span> x
                            <span> &#8369;{{ $order->price }}</span> =
                            <span> &#8369;{{ ($order->pivot->amount) }}</span>
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
                <div class="col lg-6">{{ $orders->count() }}</div>
              </div>
      
              <!-- Subtotal-->
              <div class="row py-1">
                <div class="col lg-6">Subtotal:</div>
                <div class="col lg-6">&#8369;{{ $total }}</div>
              </div>

              <!-- Shipping-->
              <div class="row py-1">
                <div class="col lg-6">Shipping:</div>
                <div class="col lg-6">&#8369; 0.00</div>
              </div>

              <!-- Total -->
              <div class="row py-1">
                <div class="col lg-6">Total:</div>
                <div class="col lg-6">
                  <span class="fw-bold">&#8369;{{ $total }}</span>
                </div>
              </div>

              {{-- <hr />
              <div class="d-flex gap-2 col-lg-7 mx-auto">
                <img src="img/payment.png" class="img-fluid" />
              </div>

              <hr />

              <div class="d-grid gap-2">
                <button class="btn btn-pr ry text-uppercase p-2" type="button">Place Order</button>
              </div> --}}
                              
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

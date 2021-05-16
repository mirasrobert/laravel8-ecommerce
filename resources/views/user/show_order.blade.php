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
              <h3 class="text-uppercase text-dark">Order #</h3>
              <small>#{{ $id }}</small>
            </li>

            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Shipping</h3>
              <small>{{ $shippingAddress->address }}</small>
            </li>

            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Payment Method</h3>
              <small>Credit or Debit Card</small>
            </li>

            <li class="list-group-item">
              <h3 class="text-uppercase text-dark">Delivered At</h3>
              <div class="alert {{ is_null($isDelivered) ? "alert-danger" : "alert-success" }}" role="alert">
                <div class="row">
                  <div class="col-md-6">
                    {{ is_null($isDelivered) ? "Not yet been delivered." : $deliveredAt }}
                  </div>
                </div>
              </div>

              @if (is_null($isDelivered))
                @can('view', auth()->user())
                
                <form action="/shop/{{ $id }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-sm btn-primary">Mark as delivered.</button>
                </form>
                @endcan
              @endif
            
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
                            <span>{{ $order->qty }}</span> x
                            <span> &#8369;{{ $order->amount }}</span> =
                            <span> &#8369;{{ ($order->qty * $order->amount) }}</span>
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

              <!-- TAX-->
              <div class="row py-1">
                <div class="col lg-6">Tax:</div>
                <div class="col lg-6">&#8369;{{ $tax }}</div>
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
                  <span class="fw-bold">&#8369;{{ $total + $tax}}.00</span>
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

          <div class="card mt-2">
              <div class="card-body">
                <h3 class="text-uppercase">Customer Details</h3>
                <hr>
              
                <!-- Subtotal Price -->
                <div class="row py-1">
                  <div class="col lg-6">Name:</div>
                  <div class="col lg-6">{{ $user->name }}</div>
                </div>
        
                <!-- Subtotal-->
                <div class="row py-1">
                  <div class="col lg-6">Address:</div>
                  <div class="col lg-6">{{ $shippingAddress->contact }}</div>
                </div>         
              </div>
            </div>
            {{-- END OF CUSTOMER --}}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
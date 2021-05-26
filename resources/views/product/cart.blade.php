@extends('layouts.app')

@section('title')
    My Cart
@endsection

@section('content')

<div>
  <section id="main-cart">
    <div class="container">
      <div class="row mt-5 py-5">
        <div class="col-lg-9 col-sm-12">
          <h1 class="">Shopping Cart</h1>

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
         
          {{-- Check If Cart is Empty --}}
          @if (MyCart::count() == 0 )
               <!-- Cart Info -->
          <div class="alert alert-info" style="margin-bottom: 10rem;" role="alert">
            Your cart is empty. <a href="{{ route('home') }}" class="alert-link">Go Back</a>
          </div>
          <!-- End Cart Info -->

          @else <!-- Show Only Pending Products -->
          <div class="bg-light d-flex text-muted mg-0 p-0">
            <div class="col-lg-3 d-lg-block d-none">Product</div>
            <div class="col-lg-3 d-lg-block d-none"></div>
            <div class="col-lg-2 d-lg-block d-none">Price</div>
            <div class="col-lg-2 d-lg-block d-none">Quantity</div>
            <div class="col-lg-2 d-lg-block d-none"></div>
          </div>

          <!-- Cart -->
          <ul class="list-group list-group-flush my-5">
            @foreach (MyCart::content() as $key => $product)
            <!-- Item -->
            <li class="list-group-item">
              <div class="d-flex justify-content-center">
                <div class="row">
                  <div class="row align-items-center">
                    <div class="col-lg-4 mx-auto m-0">
                      <a href="/product/{{ $product->id }}">
                        <img
                          src="storage/{{ $product->options->img }}"
                          class="w-75"
                          height="160"
                        />
                      </a>
                    </div>
                    <div class="col-lg-3">
                      <p class="text-dark">
                        {{ $product->name }}
                      </p>
                    </div>
                    <div class="col-lg-2">
                      <p class="text-dark">${{ $product->price }}</p>
                      <input type="hidden" name="price" value="">
                    </div>
                    
                    <div class="col-lg-2">
                      <form action="/cart" method="POST">
                        @csrf
                        @method('PUT')
                      <input
                        data-id="{{ $product->rowId }}"
                        class="form-control product_qty @error('product_qty') border border-danger @enderror"
                        type="number"
                        name="product_qty"
                        id="product_qty_{{ $product->rowId }}"
                        min="1"
                        value="{{ $product->qty }}"
                      />
                      </form>
                    </div>

                    <div class="col-lg-1">
                      <form action="/cart/{{ $product->rowId }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-lg" type="submit">
                          <i class="fa fa-trash text-danger"></i>
                        </button>
                      </form>
                    </div>  

                  </div>
                </div>
              </div>
            </li>
            <!-- End of Item -->
            @endforeach
            
          </ul>
          <!-- End of Cart -->
        </div>

        <!-- Cart Information  -->
        <div class="col-lg-3 col-sm-12 card-info">
          <div class="card">
            <div class="card-body">
              Have a coupon?
              <form class="form-inline d-flex">
                <input
                  class="form-control mr-2"
                  type="search"
                  placeholder="Coupon code"
                  aria-label="Coupon"
                />
                <button class="btn btn-primary mt-2" type="submit">Apply</button>
              </form>
            </div>
          </div>
          <div class="card mt-2">
            <div class="card-body">
              <!-- Subtotal Price -->
              <div class="row py-1">
                <div class="col lg-6">Subtotal:</div>
                <div class="col lg-6">{{ MyCart::subtotal() }}
                </div>
              </div>

              <!-- Discount-->
              <div class="row py-1">
                <div class="col lg-6">Tax (12%):</div>
                <div class="col lg-6">{{ MyCart::tax()}}</div>
              </div>

              <!-- Shipping-->
              <div class="row py-1">
                <div class="col lg-6">Shipping:</div>
                <div class="col lg-6">FREE</div>
              </div>
              <!-- Total -->
              <div class="row py-1">
                <div class="col lg-6">Total:</div>
                <div class="col lg-6">
                  <span class="fw-bold">
                    {{ MyCart::total() }}
                  </span>
                </div>
              </div>

              <hr />
              <div class="d-flex gap-2 col-lg-7 mx-auto">
                <img src="img/payment.png" class="img-fluid" />
              </div>

              <hr />
              <div class="d-grid gap-2 text-center">
                <a
                  href="{{ route('shipping.index') }}"
                  class="btn btn-primary text-uppercase p-2"
                  type="button"
                >
                  Proceed to Checkout
                </a>
              </div>
            </div>
          </div>
        </div>
          @endif
      </div>
    </div>
  </section>

</div>
@endsection

@section('extra-js')
  <script src="{{ asset('js/cartqty.js') }}"></script>
@endsection
@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
  
<section id="order">
      <div class="container">
        <div class="row py-5">
          <div class="col-lg-3 bg-light p-3">
            <small>Hello, Robert Miras</small>
            <h5 class="fw-bold mt-1" style="font-size: 1.1rem">
              Manage my Account
            </h5>
            <div class="d-flex flex-column bd-highlight mb-3">
              <div class="p-2 bd-highlight">
                <a href="#">My Profile</a>
              </div>
              {{-- <div class="p-2 bd-highlight">
                <a href="#">My Returns</a>
              </div>
              <div class="p-2 bd-highlight">
                <a href="#">My Cancellation</a>
              </div> --}}
            </div>
          </div>
          


          
          {{-- START OF CARD --}}
          <div class="col-lg-8 ms-auto">

            <table class="table table-hover">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $product)
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{-- <div class="card mt-3">
              <div class="card-header d-flex justify-content-between">
                 <span>Order #{{ $product->pivot->transaction_no }}</span>
            <span class=""> <a href="/orders/{{ $product->pivot->transaction_no }}">More</a> </span>
              </div>
              <!-- ITEM -->
                <div class="row py-2 d-flex align-items-center">
                    <div class="col-lg-2 m-2">
                        <img
                        src="storage/{{ $product->image }}"
                        alt=""
                        width="75rem"
                        height="75rem"
                        class="img-fluid"
                        />
                    </div>
                    <div class="col-lg-4">
                        <small class="text-dark my-order-name">
                          @if (strlen($product->name > 50))
                          {{ substr( $product->name , 0, 50) }} ...
                          @else 
                          {{ substr( $product->name , 0, 50) }} 
                          @endif
                        </small>
                    </div>
                    <div class="col-lg-3">
                        <p class="text-dark my-order-qty">Qty: {{ $product->pivot->qty }}</p>
                    </div>
                    <div class="col-lg-2">
                        <span
                        class="bg-danger rounded-pill p-2 text-white my-order-status"
                        style="font-size: 0.7rem"
                        >NOT PAID
                    </span>
                    </div>
                </div>
                <!-- END OF ITEM -->

              </div> --}}
            </div>
            {{-- END OF CARD --}}

          </div>
        </div>
      </div>
    </section>


@endsection

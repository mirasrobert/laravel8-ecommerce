@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

<section id="order">

      <div class="container">
        <div class="row pt-2 pb-5">

          {{-- START OF CARD --}}
          <div class="col">

            <h3>My Orders</h3>

            @if (count($order) > 0)
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="col">Order#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($order as $key => $product)
                <tr>
                  <td>{{ $product->transaction_no }}</td>
                  <td>{{ \Carbon\Carbon::parse($product->created_at)->format('F d Y') }}</td>
                  <td>
                      <span
                      class="{{ is_null($product->deliveredAt) ? 'bg-danger' : 'bg-success' }} rounded-pill p-2 text-white my-order-status"
                      style="font-size: 0.7rem">
                      {{ is_null($product->deliveredAt) ? "Pending" : "Received" }}
                    </span>
                  </td>
                  <td><span class="btn btn-light"><a style="text-decoration: none; color: #4d4d4d;" href="/orders/{{ $product->transaction_no }}">Manage</a></span></td>

                </tr>
                @endforeach

                @else

                <div class="alert alert-info" style="margin-bottom: 10rem;" role="alert">
                  You do not have any order. <a href="{{ route('home') }}" class="alert-link">Go Back</a>
                </div>

                @endif



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

    </section>


@endsection

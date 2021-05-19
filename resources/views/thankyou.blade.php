@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
<section id="thank-you">
  <div class="container">
    <div class="row py-5 mt-5">
      <div class="jumbotron text-center col-12">
        <i class="fas fa-clock fa-4x text-primary"></i>
        <h1 class="display-3">Thank You!</h1>
        @if ( session('thankyou') )
        <p class="text-muted">
          Your order number is <strong>#{{ session('thankyou') }}</strong>
        </p>
        @endif
        
        <p class="text-muted">
          <strong>Please check your email</strong> for further information
          of your order.
        </p>
        <hr />

        <p class="lead">
          <a
            class="btn btn-primary btn-sm p-2"
            href="/orders/{{ session('thankyou') }}"
            role="button"
            >Check My Order</a
          >
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
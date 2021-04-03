@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
<section id="thank-you">
  <div class="container">
    <div class="row py-5">
      <div class="jumbotron text-center">
        <i class="fas fa-clock fa-4x text-primary"></i>
        <h1 class="display-3">Thank You!</h1>
        <p class="text-muted">
          Your order number is <strong>#{{ $user->orders[0]->order_no }}</strong>
        </p>
        <p class="text-muted">
          <strong>Please check your email</strong> for further information
          of your order.
        </p>
        <hr />

        <p class="lead">
          <a
            class="btn btn-primary btn-sm"
            href="{{ route('home') }}"
            role="button"
            >Go to Shopping</a
          >
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
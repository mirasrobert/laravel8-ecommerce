@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
<section class="thank-you">
    <div class="container text-dark">
        <div
        class="d-flex align-items-center justify-content-center"
        style="height: 350px;"
      >
        <h3 class="display-3">Thank you for your order!</h3>
      </div>
    </div>
</section>
@endsection
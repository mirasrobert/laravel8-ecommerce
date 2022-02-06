@extends('layouts.app')


@section('title') Sign in @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-8">

                <h2 class="text-uppercase">Sign In</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link btn-sm float-right" style="font-size: 0.8rem"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="mt-3">
                        <span style="font-size: 0.8rem">
                            New Customer?
                            <a class="btn btn-link btn-sm"
                               href="{{ route('register') }}">
                        {{ __('Register here') }}
                            </a>
                        </span>
                    </div>


                    <div class="form-group">

                        <div class="oauth-login">
                            <button type="button"
                                    id="singInWithGoogleButton"
                                    class="btn google-color py-0 px-0 d-block mr-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-white p-2 border-rounded">
                                        <img src="{{ asset('img/google.png') }}" class="img-fluid shadow" width="20"
                                             height="20"
                                             alt="google">
                                    </div>
                                    <p class="text-white ml-3 pr-2" style="color: #fff !important;">Sign in with Google</p>
                                </div>
                            </button>

                            <button type="button"
                                    id="singInWithFacebook"
                                    class="btn facebook-color py-0 px-0 d-block">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ml-2 facebook-logo-bg p-1">
                                        <img src="{{ asset('img/facebook.png') }}" class="img-fluid shadow" width="20"
                                             height="20"
                                             alt="google">
                                    </div>
                                    <p class="text-white ml-3 pr-2 facebook-text">Sign in with Facebook</p>
                                </div>
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script>
        $(document).ready(function () {
            $('#singInWithGoogleButton').click(function () {
                window.location.href = 'auth/google';
            });

            $('#singInWithFacebook').click(function () {
                window.location.href = 'auth/facebook';
            });
        });
    </script>
@endsection

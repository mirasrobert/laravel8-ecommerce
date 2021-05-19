<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Font --}}
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700"
      rel="stylesheet"
    />

    <title>@yield('title')</title>

    <link rel="icon" href="http://assets.stickpng.com/images/5f480fb74ee26200042222e5.png" type="image/gif" sizes="8x8">

    <link
    href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet"
  />

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tooplate-main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}" />

    @yield('extra-css')
</head>
<body>
    <div id="main">
        
        @include('layouts.navigation')

        
        <main id="app">
            @yield('content')
        </main>

        @include('layouts.footer')

    </div>


<!-- Get The Current Year Dynamically -->
<script>
      document.getElementById("year").innerHTML = new Date().getFullYear();
</script>


<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- Additional Scripts -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/isotope.js') }}"></script>
<script src="{{ asset('assets/js/flex-slider.js') }}"></script>

<script language="text/Javascript">
  cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
  function clearField(t) {
    //declaring the array outside of the
    if (!cleared[t.id]) {
      // function makes it static and global
      cleared[t.id] = 1; // you could use true and false, but that's more typing
      t.value = ""; // with more chance of typos
      t.style.color = "#fff";
    }
  }
</script>

@yield('extra-js')
</body>
</html>

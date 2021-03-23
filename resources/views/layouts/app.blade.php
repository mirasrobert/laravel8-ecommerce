<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fontawesome -->
    <link
      href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{--  --}}
    @yield('extra-css')
</head>
<body>
    <div id="app">
      
        @include('layouts.navigation')

        <main class="">
            @yield('content')
        </main>

        @include('layouts.footer')

    </div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
></script>

<!-- Get The Current Year Dynamically -->
<script>
      document.getElementById("year").innerHTML = new Date().getFullYear();
</script>

@yield('extra-js')
</body>
</html>

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

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/pulse/bootstrap.min.css"
          integrity="sha384-L7+YG8QLqGvxQGffJ6utDKFwmGwtLcCjtwvonVZR/Ba2VzhpMwBz51GaXnUsuYbj" crossorigin="anonymous">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}"/>

    @yield('extra-css')
</head>
<body>
<div id="main">

    @include('layouts.navigation')


    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

</div>

<!-- Get The Current Year Dynamically -->
<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

@include('sweetalert::alert', ['cdn' => "//cdn.jsdelivr.net/npm/sweetalert2@11"])
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Additional Scripts -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/isotope.js') }}"></script>
<script src="{{ asset('assets/js/flex-slider.js') }}"></script>
<script src="{{ asset('js/navbarcollapse.js') }}"></script>


@yield('extra-js')
</body>
</html>

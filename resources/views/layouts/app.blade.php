<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mirifica Cloud">
        <meta name="author" content="mirifica-de - yves njamen">
        

        <title>MCS - @yield('title')</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

            <style>
            body {
                min-height: 75rem;
                padding-top: 4.5rem;
            }
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }

            .b-example-divider {
                height: 3rem;
                background-color: rgba(0, 0, 0, .1);
                border: solid rgba(0, 0, 0, .15);
                border-width: 1px 0;
                box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
            }

            .b-example-vr {
                flex-shrink: 0;
                width: 1.5rem;
                height: 100vh;
            }

            .bi {
                vertical-align: -.125em;
                fill: currentColor;
            }

            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }

            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
            </style>

            
            <!-- Custom styles for this template -->
            <link href="#" rel="stylesheet">
    </head>
    <body>
            
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
           @include('layouts._nav')
        </nav>

        <main class="container">

            @yield('content')

        </main>
        
        <footer class="d-flex flex-wrap align-items-center border-top">
            <p class="col-md-4 mb-0 text-muted text-center">&copy; 2022 Mirifica Srl</p>
        </footer>


        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

            
    </body>
</html>

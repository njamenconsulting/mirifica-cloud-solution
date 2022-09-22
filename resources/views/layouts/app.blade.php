<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mirifica Cloud solution">
        <meta name="author" content="mirifica-de - yves njamen">
        

        <title>MCS - @yield('title')</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


        <style type="text/css">
            .navbar .megamenu{ padding: 1rem; }
            /* ============ desktop view ============ */
            @media all and (min-width: 992px) {
                
                .navbar .has-megamenu{position:static!important;}
                .navbar .megamenu{left:0; right:0; width:100%; margin-top:0;  }
                
            }	
            /* ============ desktop view .end// ============ */


            /* ============ mobile view ============ */
            @media(max-width: 991px){
                .navbar.fixed-top .navbar-collapse, .navbar.sticky-top .navbar-collapse{
                    overflow-y: auto;
                    max-height: 90vh;
                    margin-top:10px;
                }
            }
            /* ============ mobile view .end// ============ */
        </style>
            
            <!-- Custom styles for this template -->
            <link href="#" rel="stylesheet">
    </head>
    <body>
            
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
           @include('layouts._topnav')
        </nav>

        <main class="container">

            @yield('content')

        </main>
        
        <footer class="d-flex flex-wrap align-items-center border-top">
            <p class="col-md-4 mb-0 text-muted text-center">&copy; 2022 Mirifica Srl</p>
        </footer>


        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(){
                /////// Prevent closing from click inside dropdown
                document.querySelectorAll('.dropdown-menu').forEach(function(element){
                    element.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });
                })
            }); 
            // DOMContentLoaded  end
        </script>
            
    </body>
</html>

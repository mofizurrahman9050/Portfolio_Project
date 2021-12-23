<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- Custom styles for this template-->    
    <!-- <link rel="stylesheet" href="{{asset('dashboard/css/fontawesome.css')}}"> -->
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/datatables.min.css')}}">
    </head>
    <body>
        <body class="fix-header fix-sidebar">
        
        @include('dashboard.layout.dashboard_menu')

        @yield('content')

        </div>
        </div>



          <!-- Bootstrap core JavaScript-->
    <script src="{{asset('dashboard/js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashboard/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashboard/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashboard/js/mdb.min.js')}}"></script>
    <script src="{{asset('dashboard/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('dashboard/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('dashboard/js/sticky-kit.min.js')}}"></script>
    <script src="{{asset('dashboard/js/custom.min-2.js')}}"></script>
    <script src="{{asset('dashboard/js/datatables.min.js')}}"></script>
    <script src="{{asset('dashboard/js/datatables-select.min.js')}}"></script>
    <script src="{{asset('dashboard/js/custom.js')}}"></script>
    <script src="{{asset('dashboard/js/axios.min.js')}}"></script>

    @yield('script') 

    </body>
    </html>


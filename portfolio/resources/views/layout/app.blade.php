<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">  
  <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet">  
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
  <link href="{{asset('css/aos.css')}}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>  
  <body>

    @include('layout.menu')

    @yield('content')

    @include('layout.footer')
    

      <!-- Vendor JS Files -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>  
  <script src="{{asset('js/counterup.min.js')}}"></script>
  <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.waypoints.min.js')}}"></script> 
  <script src="{{asset('js/aos.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('js/main.js')}}"></script>

  @yield('script')

  </body>
</html>
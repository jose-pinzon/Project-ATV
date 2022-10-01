<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('plantilla/img/logo/logo.png')}}" rel="icon">
  <title>Project-ATV</title>
  <link href="{{asset('plantilla/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('plantilla/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('plantilla/css/ruang-admin.min.css')}}" rel="stylesheet">
  <script src="{{asset('js/vue.js')}}"></script>
</head>

<body id="page-top">
  <div id="wrapper">
     {{-- menu  --}}
     @include('sistema.layout.menu')
     {{-- end menu --}}
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- navegacion superior -->
        @include('sistema.layout.nav')
        <!-- /navegacion superior -->

        {{-- contenido  --}}
        @yield('contenido')
        {{-- end contenido --}}

      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{asset('plantilla/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('plantilla/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('plantilla/js/ruang-admin.min.js')}}"></script>
  <script src="{{asset('plantilla/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('plantilla/js/demo/chart-area-demo.js')}}"></script>  
  @stack('js')
</body>

</html>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>{{ config('app.name', 'Laravel') }}</title> 
  <!-- Favicon -->
  <link rel="icon" href="{{ url('template_admin/assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ url('template_admin/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ url('template_admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ url('template_admin/assets/css/argon.css?v=1.2.0')}}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('template_admin/assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('diagnosa.index') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Administrator</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            @auth
           <li class="nav-item">
              <a class="nav-link" href="{{ route('tanaman.index') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Tanaman</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('daerah_gejala.index') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Daerah Gejala </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('penyakit.index') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Penyakit</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('gejala.index') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Gejala</span>
              </a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('login') }}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Login</span>
              </a>
            </li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body"><br><br><br>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">@yield('content')
                <!-- <div class="col">
                  <h3 class="mb-0">BLANK</h3>
                </div> -->
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="#" class="font-weight-bold ml-1" target="_blank">ARS Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('template_admin/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('template_admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template_admin/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('template_admin/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('template_admin/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('template_admin/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('template_admin/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('template_admin/assets/js/argon.js?v=1.2.0') }}"></script>

  <!-- =============================== -->

  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
  @stack('scriptku')
</body>
</html>




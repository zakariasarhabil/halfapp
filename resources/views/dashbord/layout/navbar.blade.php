<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashbord</title>
    <link rel="stylesheet" href={{ asset('vendors/mdi/css/materialdesignicons.min.css')}}>
    <link rel="stylesheet" href={{asset ("vendors/base/vendor.bundle.base.css")}}>
    <link rel="stylesheet" href={{asset ("css/style.css")}}>


    {{-- <link rel="stylesheet" href="{{mix('/css/bootstrap.css') }}"> --}}
</head>
<body>

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
          <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="">My App</a>
            <a class="navbar-brand brand-logo-mini" href="">My App</a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-sort-variant"></span>
            </button>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

          <ul class="navbar-nav navbar-nav-right">


            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

                <span class="nav-profile-name">  {{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>




              </div>
            </li>
        </ul>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/dashbord">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href=" {{ route('alloffice') }} ">
                <i class="mdi mdi-timetable menu-icon"></i>
              <span class="menu-title">All Office</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href=" {{ route('alladmin') }} ">
                <i class="mdi mdi-timetable menu-icon"></i>
              <span class="menu-title">All Admin</span>
            </a>
          </li>








        </ul>
      </nav>


      @yield('content')
</div>

















      <script src="{{url ('vendors/base/vendor.bundle.base.js')}}"></script>

      <script src="{{url ('vendors/datatables.net/jquery.dataTables.js')}}"></script>
      <script src="{{url ('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>



    <script src="{{url ('js/hoverable-collapse.js')}}"></script>

    <script src="{{url ('js/template.js')}}"></script>

    <script src="{{url ('js/dashboard.js')}}"></script>

    <script src="{{url ('js/data-table.js')}}"></script>

    <script src="{{url ('js/jquery.dataTables.js')}}"></script>

    <script src="{{url ('js/dataTables.bootstrap4.js')}}"></script>

    <script src="{{url ('js/jquery.cookie.js')}}"></script>

    <script src="{{url ('js/off-canvas.js')}}"></script>

    {{-- <script src="{{url ('')}}"></script> --}}

</body>
</html>

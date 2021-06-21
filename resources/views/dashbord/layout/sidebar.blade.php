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
              <span class="menu-title">all Office</span>
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
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Welcome back,</h2>
                        <p class="mb-md-0">Your analytics dashboard template.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analytics</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

      <div class="card">
        <div class="card-body dashboard-tabs p-0">
            <ul class="nav nav-tabs px-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Report</a>
                </li>

            </ul>
            <div class="tab-content py-0 px-0">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            {{-- <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i> --}}
                            <i class="mdi mdi-account-multiple mr-3 icon-lg text-danger"></i>
                            <a href=" {{ route('alloffice') }} ">
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">All Office owner</small>
                                    <h5 class="mr-2 mb-0"> {{ $office }} </h5>
                                </div>
                            </a>
                            </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-account-multiple mr-3 icon-lg text-info"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">All Marketers</small>
                                <h5 class="mr-2 mb-0"> {{ $marketer }} </h5>
                            </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            {{-- <i class="mdi mdi-download mr-3 icon-lg text-warning"></i> --}}
                            <i class="mdi mdi-account-card-details mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">All Real State </small>
                                <h5 class="mr-2 mb-0"> {{ $real_state }} </h5>
                            </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">All Request</small>
                                <h5 class="mr-2 mb-0"> {{ $req }} </h5>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
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

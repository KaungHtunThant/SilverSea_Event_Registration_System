<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ url('images/emp.png') }}" />
  <style type="text/css">
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }

        .w-auto{
            width: auto;
        }
    </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('/?orderBy=conf_id&paginate=10&page=1') }}"><img src="{{ url('images/emp.jpg') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/?orderBy=conf_id&paginate=10&page=1') }}"><img src="{{ url('images/emp.jpg') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="{{ url('#') }}" data-toggle="dropdown">
              <!-- <i class="icon-bell mx-0"></i> -->
              <!-- <span class="count"></span> -->
            </a>
           </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="{{ url('#') }}" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ url('images/user.png') }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="/logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @yield('add_form')
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/?paginate=10&page=1&orderBy=attendances.created_at" aria-expanded="false" aria-controls="dashboard">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/visitors" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/winners?orderBy=id&paginate=10&page=1&orderBy=attendances.created_at" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Winners</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/lottery" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Lottery</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/users?orderBy=id&paginate=10&page=1" aria-expanded="false" aria-controls="charts">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('contents')
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="/?orderBy=conf_id&paginate=10&page=1" target="_blank" class="">Event Pass System</a> by <a href="https://www.powerglobal.com.mm"><span class="text-danger">Power</span> <span class="text-secondary">GLobal</span></a>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ url('vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ url('js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ url('js/off-canvas.js') }}"></script>
  <script src="{{ url('js/hoverable-collapse.js') }}"></script>
  <script src="{{ url('js/template.js') }}"></script>
  <script src="{{ url('js/settings.js') }}"></script>
  <script src="{{ url('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  @yield('customjs')
  <!-- End custom js for this page-->
</body>

</html>


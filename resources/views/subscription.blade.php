<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>{{config('env.APP_NAME', "Advanced Stream Stats")}}</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{asset("assets")}}/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="{{asset("assets")}}/plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset("assets")}}/plugins/nprogress/nprogress.css" rel="stylesheet" />




  <link href="{{asset("assets")}}/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />



  <link href="{{asset("assets")}}/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />


  <link href="{{asset("assets")}}/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

  <link href="../../cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="{{asset("assets")}}/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link id="main-css-href" rel="stylesheet" href="{{asset("assets")}}/css/style.css" />
  <link id="main-css-href" rel="stylesheet" href="{{asset("assets")}}/css/plan.css" />
  <link href="{{asset("assets")}}/images/favicon.png" rel="shortcut icon" />

  <script src="{{asset("assets")}}/plugins/nprogress/nprogress.js"></script>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>




    <div class="wrapper">


        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="#">
                <img src="{{asset("assets")}}/images/logo.png" alt="Mono">
                <span class="brand-name">AS-Stats</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">

                  <li
                   class="active"
                   >
                    <a class="sidenav-item-link" href="{{route('user.index')}}">
                      <i class="mdi mdi-briefcase-account-outline"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>
                  </li>





                  <li
                   >
                    <a class="sidenav-item-link" href="{{route('subscription.index')}}">
                      <i class="mdi mdi-chart-line"></i>
                      <span class="nav-text">Subscription</span>
                    </a>
                  </li>
                </ul>

            </div>

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  <li>
                    <a href="#" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a></li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="No chat messages"><i class="mdi mdi-chat-processing"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>



      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">

          <!-- Header -->
          <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>

              <span class="page-title">Welcome, <b> {{auth()->user()->lastname}} {{auth()->user()->firstname}} </b> </span>

              <div class="navbar-right ">

                <ul class="nav navbar-nav">


                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="{{asset("assets")}}/images/user/user.png" class="user-image rounded-circle" alt="User Image" />
                      <span class="d-none d-lg-inline-block">{{auth()->user()->lastname}} {{auth()->user()->firstname}}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a class="dropdown-link-item" href="#">
                          <i class="mdi mdi-account-outline"></i>
                          <span class="nav-text">My Profile</span>
                        </a>
                      </li>

                      <li>
                        <a class="dropdown-link-item" href="#">
                          <i class="mdi mdi-settings"></i>
                          <span class="nav-text">Account Setting</span>
                        </a>
                      </li>

                      <li class="dropdown-footer">
                        <a class="dropdown-link-item" href="{{route('auth.logout')}}"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>


          </header>

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">


                <div class="row">
                  <div class="col-xl-8">

                    <!-- Income and Express -->
                    <div class="container">
                        <div>
                            <p class="h2 text-center mb-5">Choose Your Perfect Plans</p>
                        </div>
                        <div class="row mt-6">
                            @if (count($plans) > 0)
                                @foreach ($plans as $key => $plan)
                                    <div class="col-lg-5 col-md-6 ">
                                        <div class="card d-flex align-items-center justify-content-center">
                                            <div class="ribon">
                                                <span class="mdi mdi-settings"></span>
                                            </div>
                                            <p class="h-1 pt-5">{{$plan->name}}</p>
                                            <span class="price">
                                                <sup class="sup">$</sup>
                                                <span class="number">{{$plan->price}}/</span><sup class="sup">{{$plan->period}}</sup>
                                            </span>
                                            <ul class="mb-5 list-unstyled text-muted">
                                                <li>
                                                    <span class="mdi mdi-check me-2"></span>Free analytics
                                                </li>
                                                <li><span class="mdi mdi-check me-2"></span>Unlimited Data</li>
                                                <li><span class="mdi mdi-check me-2"></span>100 Streams</li>
                                            </ul>
                                            <div class="btn btn-primary"> get started </div>
                                        </div>
                                    </div>
                                @endforeach

                            @endif
                        </div>
                    </div>


                  </div>
                </div>




</div>

        </div>

          <!-- Footer -->
          <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Advance Stream Stats by <a class="text-primary" href="https://www.linkedin.com/in/damilola-akinwunmi-377589b0/" target="_blank" >Damilola</a>.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>

      </div>
    </div>

                    <script src="{{asset("assets")}}/plugins/jquery/jquery.min.js"></script>
                    <script src="{{asset("assets")}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="{{asset("assets")}}/plugins/simplebar/simplebar.min.js"></script>
                    <script src="../../unpkg.com/hotkeys-js%403.10.1/dist/hotkeys.min.js"></script>



                    <script src="{{asset("assets")}}/plugins/apexcharts/apexcharts.js"></script>



                    <script src="{{asset("assets")}}/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>



                    <script src="{{asset("assets")}}/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
                    <script src="{{asset("assets")}}/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
                    <script src="{{asset("assets")}}/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>



                    <script src="{{asset("assets")}}/plugins/daterangepicker/moment.min.js"></script>
                    <script src="{{asset("assets")}}/plugins/daterangepicker/daterangepicker.js"></script>
                    <script>
                      jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
                    </script>



                    <script src="../../cdn.quilljs.com/1.3.6/quill.js"></script>



                    <script src="{{asset("assets")}}/plugins/toaster/toastr.min.js"></script>



                    <script src="{{asset("assets")}}/js/mono.js"></script>
                    <script src="{{asset("assets")}}/js/chart.js"></script>
                    <script src="{{asset("assets")}}/js/map.js"></script>
                    <script src="{{asset("assets")}}/js/custom.js"></script>


  </body>
</html>

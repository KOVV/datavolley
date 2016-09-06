<!DOCTYPE html>
<html lang="en">
  <head>
@section('header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>KOVV - Portal @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href={{ URL::asset('assets/css/bootstrap.css') }} rel="stylesheet">

    <!--external css-->
    <link href={{ URL::asset('assets/font-awesome/css/font-awesome.css') }} rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href={{ URL::asset('assets/css/style.css') }} rel="stylesheet">
    <link href={{ URL::asset('assets/css/style-responsive.css') }} rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.css"/>
@show
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>KOVV portal</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login.html">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src={{ URL::asset("assets/img/ui-sam.jpg") }} class="img-circle" width="60"></a></p>
              	  <h5 class="centered">{{ $name }}</h5>
              	  	
                  

                  @yield('menuDetectie')
                  

                   

                  
                  
                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

         @yield('content')
          </section>
      </section>

      
  </section>
@section('footer')
    <!-- js placed at the end of the document so the pages load faster -->
    <script src={{ URL::asset('assets/js/jquery.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery-1.8.3.min.js') }}></script>
    <script src={{ URL::asset('assets/js/bootstrap.min.js') }}></script>
    <script class="include" type="text/javascript" src={{ URL::asset('assets/js/jquery.dcjqaccordion.2.7.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery.scrollTo.min.js')}}></script>
    <script src={{ URL::asset('assets/js/jquery.nicescroll.js')}} type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.1.1/js/dataTables.autoFill.min.js"></script>


    <!--common script for all pages-->
    <!--
    <script src={{ URL::asset('assets/js/admin.js')}}> </script>
    -->
    <script src={{ URL::asset('assets/js/common-scripts.js')}}></script>
 
	
  @show

  </body>
</html>

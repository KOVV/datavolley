<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>KOVV - Detectie</title>

  <!-- Bootstrap core CSS -->
  <link href={{ URL::asset('assets/css/bootstrap.css') }} rel="stylesheet">

  <!--external css-->
  <link href={{ URL::asset('assets/font-awesome/css/font-awesome.css') }} rel="stylesheet" />
  <link href={{ URL::asset('assets/css/jumbotron.css') }} rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.css"/>


   
    </head>

    <body style="height:inherit; padding:0px;">
      <div class="container" style="height:inherit;">

        <div  class="row"  style="text-align:center;    font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 300;
        color: #888;
        line-height: 30px;">


        <div class="col-xs-12">

          <img src="/assets/img/logo-kovv.jpg" style="padding-top:25px;"></img>
          
          <h1 style="color:black; opacity:0.8;font-weight:100">Inschrijven <strong>DETECTIE</strong> 2016</h1>

          <a href="#topAlert"></a>
          <div   hidden class="alert alert-success" id="topAlert" role="alert"></div>

        </div>
      </div>
      



    <!-- js placed at the end of the document so the pages load faster -->
    <script src={{ URL::asset('assets/js/jquery.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery-1.8.3.min.js') }}></script>


    <script>


    </script>

    <script src={{ URL::asset('assets/js/bootstrap.min.js') }}></script>
    <script class="include" type="text/javascript" src={{ URL::asset('assets/js/jquery.dcjqaccordion.2.7.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery.scrollTo.min.js')}}></script>
    <script src={{ URL::asset('assets/js/jquery.nicescroll.js')}} type="text/javascript"></script>




    <!--common script for all pages-->
    <!--
    <script src={{ URL::asset('assets/js/admin.js')}}> </script>
  -->
  <script src={{ URL::asset('assets/js/common-scripts.js')}}></script>







  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
  <script>
  
var sPageURL = decodeURIComponent(window.location.search.substring(1)),
sURLVariables = sPageURL.split('&'),
sParameterName,
i, 
par;
var hasTokenFlag = 0;
for (i = 0; i < sURLVariables.length; i++) {
sParameterName = sURLVariables[i].split('=');
console.log(sParameterName);
if (sParameterName[0] === "actStatus") {

par = sParameterName[1];

}
}


switch (par){
  case '1':
    $('#topAlert').text('Bedankt voor jouw registratie. Tot 3 september!');
    $('#topAlert').show();
  break;
  case '2':
      $('#topAlert').text('Bedankt voor jouw registratie. Jammer dat je er op 3 september niet bij kan zijn, maar we houden je op de hoogte van verdere activiteiten.');
    $('#topAlert').show();
  break;
  case '3':
 $('#topAlert').text('Bedankt om ons iets te laten weten.');
    $('#topAlert').show();
  break;

}

  </script>




</body>
</html>




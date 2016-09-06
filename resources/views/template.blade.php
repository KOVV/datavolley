<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Test page for the detectie flow">
    <meta name="author" content="kovv Volley detectie test">
    <link rel="icon" href="../../favicon.ico">

    <title>Theme Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../framework/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../framework/twbs/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../framework/twbs/bootstrap/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../framework/twbs/bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.css"/>

<meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
 
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bootstrap theme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Detectie flow</h1>
        <p>Deze testpage bevat de volledige detectieflow zonder layout. Dit is een pagina om puur de functionele kant te testen</p>
      </div>

  
<?php echo $child; ?>
     


    </body> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   
    <script>window.jQuery || document.write('<script src="../../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../framework/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../framework/twbs/bootstrap/docs/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../framework/twbs/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.1.1/js/dataTables.autoFill.min.js"></script>
 <script src="../js/detectie.js"></script> 
<script>

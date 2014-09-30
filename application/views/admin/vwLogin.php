<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  <!--   Code By Abhishek R. Kaushik  -->
    <title>Go Deals</title>
    <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
    <script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>admin/login.css" />
    <style>
      
    </style>
  </head>

  <body>

    <div class="container">
        <div class="row">
            <div class="large-5 large-centered columns">
                <div id="alertMsg" data-alert class="alert-box alert round">Hello</div>
            </div>
        </div>
        
        <div class="form-signin panel">
            <center><div class="logoLogin"></div></center>
            <input type="text" placeholder="Usuario" id="username" autofocus>
            <input type="password" placeholder="Password" id="password">
            <label class="checkbox">
              <input type="checkbox" value="remember-me">Recordarme
            </label>
            <div class="row">
                <div class="large-6 large-centered columns">
                    <button id="login" class="radius blue button">Ingresar</button>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
    
    <!-- Commons -->
    <script>
        var URL_BASE = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/foundation.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().JS; ?>admin/login.js"></script>
      
  </body>
</html>
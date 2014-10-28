<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Go Deals</title>
    <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
    <script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>admin/common.css" />

  </head>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'dashboard'  ;    
    ?>
    
    <nav class="top-bar" data-topbar>
        
        <ul class="title-area">
            <li class="name"><h1><a href="#"> Go Deals</a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <ul class="left">
                <li class="divider"></li>
                <li <?php echo  $pg =='dashboard' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='cupones' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/cupones">Cupones</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='eventos' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/eventos">Eventos</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='partners' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/partners">Comercios</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='sporttv' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/sporttv">Sport TV</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='publicidad' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/publicity">Publicidad</a></li>
                <li class="divider"></li>
                <li <?php echo  $pg =='place' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/place">Lugar</a></li>
                <li class="divider"></li>
            </ul>
            <ul class="right">
                <li class="divider"></li>
                <li><a  href="<?php echo base_url(); ?>admin/home/logout">Salir</a></li>
            </ul>
        </section>
        
    </nav>
    


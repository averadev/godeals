<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/vendor/modernizr.js"></script>
        <link media="screen" href="<?php echo base_url().IMG; ?>prox/msg/jquery.msg.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/contact.css" />
    </head>
    <body>

        <!-- Modal Cupones -->

        <?php $this->load->view('web/vwStickyMenu'); ?>


        <?php $this->load->view('web/vwHeader'); ?>

        <?php $this->load->view('web/vwMainMenu'); ?>
        
        <div id="gMap"></div>
        
        <div class="contacto">
            <div class="row">
                <h1 class="text-center titleContact">CONTACTO</h1>
            </div>
            <div class="row contactForm">
                <div class="medium-6 columns">
                    <input class="input" id="name" type="text" placeholder="Nombre" />
                    <input class="input" id="email" type="text" placeholder="Email" />
                    <input class="input" id="subject" type="text" placeholder="Asunto" />
                    <textarea class="input" id="mesage" rows="5" placeholder="Mensaje"></textarea>
                    <image id="btnEnviar" src="<?php echo base_url().IMG; ?>web/btnContactEnviar.png" />
                </div>
                <div class="medium-1 columns">&nbsp;</div>
                <div class="medium-5 columns">
                    <p class="txtDesc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p class="txtDesc">
                        Tel: 45456465156<br/>
                        Fax: 46545645454
                        <a class="social" ><img src="<?php echo base_url().IMG; ?>web/btnContactFB.png" /></a>
                        <a class="social"><img src="<?php echo base_url().IMG; ?>web/btnContactTW.png" /></a>
                    </p>
                </div>
            </div>
        </div>

        <?php $this->load->view('web/vwFooter'); ?>

        <!-- Commons -->
        <script>
            var URL_IMG = '<?php echo base_url() . IMG; ?>';
            var URL_BASE = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA01vZmL-1IdxCCJevyBdZSEYJ04Wu2EWE&sensor=false"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().IMG; ?>prox/msg/jquery.center.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().IMG; ?>prox/msg/jquery.msg.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/contact.js"></script>
    </body>
</html>
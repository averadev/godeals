<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>        
        <link rel="stylesheet" href="<?php echo base_url() . FOUND; ?>css/foundation.css" />
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/apps.css" />
    </head>
    <body>

        <!-- Modal Cupones -->

        <?php $this->load->view('web/vwStickyMenu'); ?>


        <?php $this->load->view('web/vwHeader'); ?>

        <?php $this->load->view('web/vwMainMenu'); ?>
        
        <div class="grayBand">
            <div class="row appTop">
                <img src="<?php echo base_url().IMG; ?>web/appHead.jpg">
                <div class='btnAppTop'>
                    <a class="btnAppStore" target="_blank" href="https://play.google.com/store/apps/details?id=mx.godeals"><img src="<?php echo base_url().IMG; ?>web/btnApp2.png" /></a>
                    <a class="btnAppStore" target="_blank" href="https://itunes.apple.com/us/app/go-deals/id932481336?l=es"><img src="<?php echo base_url().IMG; ?>web/btnApp1.png" /></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <h1  class="text-center">GO DEALS CONTIGO EN TODO MOMENTO</h1><br/>
                <h5  class="text-center">Mantente informado de los próximos eventos, o donde ver los eventos deportivos,<br/>asi como de las mejores ofertas y promociones.</h5>
            </div>
        </div>
        <div class="row">
            <img src="<?php echo base_url().IMG; ?>web/appImgs.jpg">
        </div>
        <div class="grayBand">
            <div class="row appBottom">
                <img src="<?php echo base_url().IMG; ?>web/appFoot.jpg">
                <div class='btnAppBottom'>
                    <a class="btnAppStore" target="_blank" href="https://play.google.com/store/apps/details?id=mx.godeals"><img src="<?php echo base_url().IMG; ?>web/btnApp2.png" /></a>
                    <a class="btnAppStore" target="_blank" href="https://itunes.apple.com/us/app/go-deals/id932481336?l=es"><img src="<?php echo base_url().IMG; ?>web/btnApp1.png" /></a>
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
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.tab.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/foundation/foundation.accordion.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>web/faq.js"></script>
    </body>
</html>
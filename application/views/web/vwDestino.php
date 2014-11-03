
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
		<script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/destino.css" />
    </head>
    <body>
        
        <?php $this->load->view('web/vwStickyMenu'); ?>
        
        <?php $this->load->view('web/vwHeader'); ?>
        
        <!-- Publicidad -->
        <div class="row publicidad">
            <?php foreach ($medioBanner as $item):?>
                <div class="medium-6 columns"><img class="publish" src="<?php echo base_url().IMG; ?>app/publicity/mediobanner/<?php echo $item->image;?>"/></div>
            <?php endforeach;?>
        </div>
        
        <?php $this->load->view('web/vwMainMenu'); ?>
        
        
        <div class="row spaceBar"></div>
        
        <!-- Seccion Contenido -->
        <div class="row title">
            <p><?php echo $destino->title;?></b></p>
        </div>
        
        <div class="row">
            <ul class="tabs" data-tab>
                <li class="tab-title active"><a href="#panel1">Información</a></li>
                <li class="tab-title" id="tabMapa"><a href="#panel2">Mapa</a></li>
            </ul>
            <div class="tabs-content">
                <div class="content active" id="panel1">
                    <div class="row">
                        <div class="medium-8 columns conoce">
                            CONOCE <b>CANCUN</b>
                        </div>
                        <div class="medium-4 columns">
                            <div class="socialDestino">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-8 columns masterContainer">
                            <img class="master" src="<?php echo base_url().IMG; ?>app/visita/galeria/<?php echo $photos[0]->image;?>"/>
                        </div>
                        <div class="medium-4 columns">
                            <?php foreach ($photos as $item):?>
                                <img class="thumb" src="<?php echo base_url().IMG; ?>app/visita/galeria/thumb_<?php echo $item->image;?>"/>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="row detail">
                        <?php echo $destino->txtMax;?>
                    </div>
                </div>
                <div class="content" id="panel2">
                    <div id="gMap" class="row"></div>
                </div>
                <div class="content" id="panel3">
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Hospedaje]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Hospedaje]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Hospedaje]"/>
                </div>
                <div class="content" id="panel4">
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Restaurante]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Restaurante]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[Restaurante]"/>
                </div>
                <div class="content" id="panel5">
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[BAR]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[ANTRO]"/>
                    <img class="rowTmp" src="http://placehold.it/1000x150&text=[COWABUNGA]"/>
                </div>
            </div>
        </div>
        
        
        <div class="row spaceBar"></div>
        <div class="row spaceBar"></div>
        
        <?php $this->load->view('web/vwFooter'); ?>
        
        <!-- Commons -->
        <script>
            var URL_IMG = '<?php echo base_url().IMG; ?>';
            var URL_BASE = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/foundation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/destino.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA01vZmL-1IdxCCJevyBdZSEYJ04Wu2EWE&sensor=false"></script>
        
    </body>
</html>
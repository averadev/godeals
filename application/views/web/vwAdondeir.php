
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
		<script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/adondeir.css" />
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
        
        <!-- Seccion Mapa -->
        <div class="row mapa">
            <div class="medium-8 columns nopadding">
                <div id="gMap"></div>
            </div>
            <div class="medium-4 columns">
                <p class="mapTitle" marker="latCancun">CANCUN</p>
                <p class="mapSub" marker="latIsla">13 KM DE ISLA MUJERES</p>
                <p class="mapSub" marker="latValladolid">156 KM DE VALLADOLID</p>
                <p class="mapSub" marker="latHolbox">140 KM DE HOLBOX</p>
                
                <p class="mapSub" marker="latPueroM">36 KM DE PUERTO MORELOS</p>
                <p class="mapSub" marker="latPlaya">68 KM DE PLAYA DEL CARMEN</p>
                <p class="mapSub" marker="latCozumel">72 KM DE COZUMEL</p>
                <p class="mapSub" marker="latMerida">285 KM DE MERIDA</p>
                <p class="mapSub" marker="latChichen">178 KM DE CHICHEN ITZA</p>
                <p class="mapSub" marker="latCoba">173 KM DE COBA</p>
                <p class="mapSub" marker="latTulum">131 KM DE TULUM</p>
                <p class="mapSub" marker="latXelha">122 KM DE XELHA</p>
                <p class="mapSub" marker="latXcaret">74 KM DE XCARET</p>
            </div>
        </div>
        
        <!-- Seccion Contenido -->
        <div class="row title">
            <p>¿A DONDE QUIERES IR <b>HOY</b>?</p><hr>
        </div>
        
        <div class="row subTitle">
            <p>¿De visita por Cancún y la Riviera Maya?<br/>
                ¡Deja que Go Deals sea tu guía para saber que hacer y a donde ir 
                en cada lugar que te encuentres!<br/>
                Conoce como llegar, donde hospedarte, galería de fotos, y mucho mas.</p>
        </div>
        
        <div class="row menuAdondeir">
            <div class="medium-1 columns">&nbsp;</div>
            <?php foreach ($categoria1 as $item):?>
                <div class="medium-2 columns menu <?php if($item->id == $sel){echo 'menuSel';} ?>" 
                     attr-id="<?php echo $item->id;?>" ><span><?php echo $item->name;?></span></div>
            <?php endforeach;?>
            <div class="medium-1 columns">&nbsp;</div>
        </div>
        <div class="row menuAdondeir">
            <div class="medium-2 columns">&nbsp;</div>
            <?php foreach ($categoria2 as $item):?>
                <div class="medium-2 columns menu <?php if($item->id == $sel){echo 'menuSel';} ?>" 
                     attr-id="<?php echo $item->id;?>" ><span><?php echo $item->name;?></span></div>
            <?php endforeach;?>
            <div class="medium-2 columns">&nbsp;</div>
        </div>
        
        <div class="row spaceBar"></div>
        
        <?php foreach ($destinos as $item):?>
            <div class="row section">
                <hr />
                <div class="topBar"><?php echo $item->title;?></div>
                <ul class="sliderAdondeir" data-orbit >
                    <?php foreach ($item->banner as $banner):?>
                        <li><img src="<?php echo base_url().IMG; ?>app/visita/banner/<?php echo $banner->image;?>"/></li>
                    <?php endforeach;?>
                </ul>
                <div class="descSection">
                    <div class="medium-6 columns">
                        <div class="medium-6 columns toggleB clima"><p>Consultar Clima</p>
                            <span class="toggleSelect"><img src="<?php echo base_url().IMG; ?>web/toggleB1.png" /></span></div>
                        <div class="medium-6 columns toggleB"><p>Transportación</p>
                            <span><img src="<?php echo base_url().IMG; ?>web/toggleB2.png" /></span></div>

                        <div attr-weather="<?php echo $item->weatherKey;?>" class="info1 weather">
                        </div>
                        <div class="info2">
                            <?php foreach ($item->transport as $transport):?>
                                <div class="medium-6 columns infoT<?php echo $transport->id;?>"><?php echo $transport->name;?></div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="medium-6 columns consultar">
                        <p class="secInfoTitle"><?php echo $item->title;?></p>
                        <p class="secInfoDesc"><?php echo $item->txtMin;?></p>
                        <div class="medium-6 columns">&nbsp;</div>
                        <div class="medium-6 columns"><a attr-id="<?php echo $item->id;?>" attr-name="<?php echo $item->name;?>" class="btnView"><img class="moreInfo" src="<?php echo base_url().IMG; ?>web/btnAdondeSection2.png" /></a></div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        
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
        <script type="text/javascript" src="<?php echo base_url().WEATHER; ?>jquery.simpleWeather.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/adondeir.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA01vZmL-1IdxCCJevyBdZSEYJ04Wu2EWE&sensor=false"></script>
        
    </body>
</html>
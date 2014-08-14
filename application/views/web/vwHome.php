
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
        <link rel="stylesheet" href="<?php echo base_url().SHAPE; ?>css/component.css" />
        <link rel="stylesheet" href="<?php echo base_url().CAPTION; ?>css/component.css" />
		<script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/home.css" />
    </head>
    <body>
        
        <!-- Loading -->
        <div class="progress-indicator">
            <img src="<?php echo base_url().IMG; ?>web/loading.gif" alt="" />
        </div>
        
        <!-- Modal Cupones -->
        <div id="couponModal" class="reveal-modal" data-reveal>
            <div id="topbarEvent">
                <img id="eventFb" src="<?php echo base_url().IMG; ?>web/eventFb.png">
                <img id="eventTw" src="<?php echo base_url().IMG; ?>web/eventTw.png">
                <img id="eventClose" src="<?php echo base_url().IMG; ?>web/eventClose.png">
            </div>
            <div class="large-10 medium-9 columns nospc">
                <center><img id="imgFull" src="<?php echo base_url().IMG; ?>app/coupon/max/00.png"></center>
            </div>
            <div class="large-2 medium-3 columns nospc" id="modalContent">
            </div>
        </div>
                
        <?php $this->load->view('web/vwStickyMenu'); ?>
        
        
        <div id="slideout">
            <div id="slideout_inner">
                <a><img src="<?php echo base_url().IMG; ?>web/btnApp1.png" /></a><br/>
                <a><img src="<?php echo base_url().IMG; ?>web/btnApp2.png" /></a>
            </div>
            <img id="showApps" src="<?php echo base_url().IMG; ?>web/btnApps.png" alt="Feedback" />
        </div>
        
        <?php $this->load->view('web/vwHeader'); ?>
        
        <!-- Top Slider -->
        <div class="slider">
            <div class="row">
                <div class="large-12 columns">
                    <ul id="topSlider" data-orbit 
                        data-options="timer: true;
                            timer_speed: 6000;
                            pause_on_hover:false;" >
                        
                     <?php foreach ($banner as $item):?>
                        <li>
                            <img class="banner" src="<?php echo base_url().IMG; ?>app/banner/<?php echo $item->image;?>" />
                            <div class="gradientBanner"></div>
                            <div class="logoBanner">
                                <div class="row">
                                    <div class="large-4 small-4 columns">
                                        <img class="afiliadoLink" src="<?php echo base_url().IMG; ?>app/logo/<?php echo $item->logo;?>" />
                                        <img class="promoLink" attr-partner="<?php echo $item->partnerId;?>" src="<?php echo base_url().IMG; ?>web/promociones.png" />
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                        
                    </ul>
                </div>
            </div>
        </div>    
        <!-- Termina Slider -->
        
        
        <!-- Head Menu -->
        <div class="headMenu">
            <div class="row">
                <div class="large-8 small-8 columns desc">
                    Recibe las mejores ofertas en tiempo record!
                </div>
                <div class="large-4 small-4 columns">
                    <div class="row collapse">
                        <div class="medium-10 columns">
                            <input class="txtSus" type="text" placeholder="Suscribete" />
                        </div>
                        <div class="medium-2 columns">
                            <div class="btnSus0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Menu Buttons -->
        <div class="mainMenu">
            <div class="row">
                <div class="homeMenu optMenu">
                    <a href="<?php echo base_url(); ?>eventos"><img class="optImg" src="<?php echo base_url().IMG; ?>web/btnMenu1.png" /></a>
                    <div class="optHead">EVENTOS</div>
                    <div class="optDesc">Toda la información de los eventos en tu ciudad y descuentos especiales.</div>
                </div>
                <div class="homeMenu optMenu">
                    <a href="<?php echo base_url(); ?>entretenimiento"><img class="optImg" src="<?php echo base_url().IMG; ?>web/btnMenu2.png" /></a>
                    <div class="optHead">ENTRETENIMIENTO</div>
                    <div class="optDesc">Bares, antros, restaurantes y mas con increibles promociones.</div>
                </div>
                <div class="homeMenu optMenu">
                    <a href="<?php echo base_url(); ?>productos"><img class="optImg optProductos" src="<?php echo base_url().IMG; ?>web/btnMenu3.png" /></a>
                    <div class="optHead">PRODUCTOS Y SERVICIOS</div>
                    <div class="optDesc">Date un gusto a ti y a tu economia.</div>
                </div>
                <div class="homeMenu optMenu">
                    <a href="<?php echo base_url(); ?>adondeir"><img class="optImg" src="<?php echo base_url().IMG; ?>web/btnMenu4.png" /></a>
                    <div class="optHead">¿A DONDE IR?</div>
                    <div class="optDesc">Los lugares para conocer en destinos cercanos. ¡Viaja con Go Deals como guía!.</div>
                </div>
                <div class="homeMenu optMenu">
                    <a href="<?php echo base_url(); ?>sporttv"><img class="optImg" src="<?php echo base_url().IMG; ?>web/btnMenu5.png" /></a>
                    <div class="optHead">SPORT TV</div>
                    <div class="optDesc">Disfruta tus eventos deportivos con las mejores promociones.</div>
                </div>
            </div>
        </div>
        
        <!-- Cupones -->
        <div class="cupones">
            <div class="row">
                <div class="large-8 columns leftCoupons">
                    <div class="row">&nbsp;</div>
                    <ul class="cs-style-2">
                    
                    <?php foreach ($cupones as $item):?>
                        <li>
                            <figure class="couponObj">
                                <img  class="openModal"src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $item->image;?>">
                                <figcaption>
                                    <h3><?php echo $item->description;?></h3>
                                    <span>
                                        <u class="linkPartner" attr-id="<?php echo $item->partnerId;?>"><?php echo $item->partnerName;?></u> in 
                                        <u class="linkCity" attr-id="<?php echo $item->partnerId;?>"><?php echo $item->cityName;?></u></span>
                                    <a class="openModal" attr-id="<?php echo $item->id;?>">Look</a>
                                </figcaption>
                            </figure>
                        </li>
                    <?php endforeach;?>
                        
                    </ul>
                </div>
                <div class="large-4 columns rightCoupons">
                    <div class="row rHead"><img src="<?php echo base_url().IMG; ?>web/btnTiempo.png"></div>
                    <ul class="cs-style-2">
                    
                    <?php foreach ($timers as $item):?>
                        <li>
                            <figure class="couponObj">
                                <img  class="openModal"src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $item->image;?>">
                                <figcaption>
                                    <h3><?php echo $item->description;?></h3>
                                    <span>
                                        <u class="linkPartner" attr-id="<?php echo $item->partnerId;?>"><?php echo $item->partnerName;?></u> in 
                                        <u class="linkCity" attr-id="<?php echo $item->partnerId;?>"><?php echo $item->cityName;?></u></span>
                                    <a class="openModal" attr-id="<?php echo $item->id;?>">Look</a>
                                </figcaption>
                            </figure>
                        </li>
                    <?php endforeach;?>
                        
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Recomendaciones -->
        <div class="mainRecomendacion">
            <!-- Top Slider -->
            <div class="row">
                <div class="large-12 columns">
                    <ul id="topSlider" data-orbit data-options="timer: false; slide_number: false;" >
                        <li>
                            <img class="banner" src="<?php echo base_url().IMG; ?>app/visita/01.jpg" />
                            <div class="bgRecom">
                                <div style="width:100%">
                                    <div class="medium-4 bgRecom1 columns">
                                        <img class="banner" src="<?php echo base_url().IMG; ?>app/visita/01.logo.jpg" />
                                        <p><b>Lunes a Sábado<br/>
                                            de 9:00 am a 5:00pm<br/>
                                            Carretera Federal 307, km 282
                                        </b></p>
                                        <p><b>A</b> solo 56 km del Aeropuerto Internacional de Cancún, a 6 km
                                            al sur de Playa del Carmen y a 55 km al norte de Tulum.
                                        </p>
                                        <a>http://es.xplor.travel</a>
                                    </div>
                                    <div class="medium-8 bgRecom2 columns" style="background: url('<?php echo base_url().IMG; ?>web/bgRecom2.png') repeat;">
                                        <p class="titleRecom">
                                            AVENTURA SIN LIMITES 
                                            <span class="recomSocial">
                                                <img src="<?php echo base_url().IMG; ?>web/btnRecomSocial1.png" />
                                                <img src="<?php echo base_url().IMG; ?>web/btnRecomSocial2.png" />
                                                <img src="<?php echo base_url().IMG; ?>web/btnRecomSocial3.png" />
                                            <span>
                                        </p>
                                        <p class="descRecom">
                                            La selva cobra vida en el mejor parque de aventura en la Riviera Maya. 
                                            El Parque Xplor es un mundo subterráneo único, donde disfrutarás de una aventura inigualable. 
                                            De día vuela entre árboles y cuevas, descubre las asombrosas grutas y extraordinarias formaciones rocosas. 
                                            Y de noche deja que la luna y las estrellas guíen tu camino, asómbrate con los misterios que 
                                            Xplor Fuego tiene guardados para ti.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img class="banner" src="<?php echo base_url().IMG; ?>app/visita/02.jpg" />
                            <div class="bgRecom">
                                <div style="width:100%">
                                    <div class="medium-4 bgRecom1 columns">
                                        <img class="banner" src="<?php echo base_url().IMG; ?>app/visita/02.logo.png" />
                                        <p><b>Lunes a Sábado<br/>
                                            de 9:00 am a 5:00pm<br/>
                                            Carretera Federal 307, km 282
                                        </b></p>
                                        <a>http://yax-ha-parque.com</a>
                                    </div>
                                    <div class="medium-8 bgRecom2 columns" style="background: url('<?php echo base_url().IMG; ?>web/bgRecom3.png') repeat;">
                                        <p class="titleRecom">
                                            EXPLORA - SUEÑA - DESCUBRE
                                        </p>
                                        <p class="descRecom">
                                            El parque Ecoturistico cuenta con diferentes actividades que garantizan la diversión y el entretenimiento 
                                            como son paseos a caballos, bicicletas de montañas, caminatas interpretativas, lunadas, campamentos, 
                                            caminatas nocturnas y observación de flora y fauna entre otras.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            
        <!-- Seccion Eventos -->
        <div class="row">
            <div class="large-12 columns">
                <div class="row">
                    <div class="small-10 large-10 small-centered large-centered columns titleEvent">
                        LOS MEJORES <b>DEALS</b><br/> PARA LOS MEJORES EVENTOS <img src="<?php echo base_url().IMG; ?>web/btnArrowDouble.png" /> </div>
                </div>
                <div class="mainEvents">
                    <section id="grid" class="grid clearfix">
                        <?php foreach ($events as $item):?>
                            <a data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
                                <figure>
                                    <img src="<?php echo base_url().IMG; ?>app/event/med/<?php echo $item->imgMed;?>" />
                                    <svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
                                    <figcaption>
                                        <h2><?php echo $item->word;?></h2>
                                        <p><?php echo $item->name;?><br/>
                                            <?php echo date('d', strtotime($item->date)); ?> de 
                                            <?php echo $natMonth[date('n', strtotime($item->date))]; ?>.</p>
                                        <button>View</button>
                                    </figcaption>
                                </figure>
                            </a>
                        <?php endforeach;?>
                    </section>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('web/vwFooter'); ?>
        
        <!-- Commons -->
        <script>
            var URL_IMG = '<?php echo base_url().IMG; ?>';
            var URL_BASE = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/foundation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().SHAPE; ?>js/snap.svg-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().SHAPE; ?>js/hovers.js"></script>
        <script type="text/javascript" src="<?php echo base_url().CAPTION; ?>js/toucheffects.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/jquery.isloading.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/home.js"></script>
    </body>
</html>
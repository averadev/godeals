
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
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/sporttv.css" />
    </head>
    <body>
        
        <!-- Modal Cupones -->
        <div id="eventModal" class="reveal-modal" data-reveal>
            <div id="topbarEvent">
                <img id="eventFb" src="<?php echo base_url().IMG; ?>web/eventFb.png">
                <img id="eventTw" src="<?php echo base_url().IMG; ?>web/eventTw.png">
                <img id="eventClose" src="<?php echo base_url().IMG; ?>web/eventClose.png">
            </div>
            <div class="large-10 small-8 columns nospc">
                <center><img id="imgFull" src="<?php echo base_url().IMG; ?>app/event/max/00.png"></center>
            </div>
            <div class="large-2 small-4 columns nospc">
                <ul class="menuModal">
                    <li><a class="id1 selOptEvt" href="#home">Publicidad del Evento</a></li>
                    <li><a class="id2" href="#news">¿Como llegar?</a></li>
                    <li><a class="id3" href="#contact">Comprar Boletos</a></li>
                    <li><a class="id4" href="#about">Inscripciones del evento</a></li>
                    <li><a class="id5" href="#about">Promocion especial</a></li>
                </ul>
            </div>
            
        </div>
                
        <?php $this->load->view('web/vwStickyMenu'); ?>
        
        
        <?php $this->load->view('web/vwHeader'); ?>
        
        <!-- Publicidad -->
        <div class="row publicidad">
            <div class="medium-6 columns"><img class="publish" src="http://placehold.it/500x300&text=[ad]"/></div>
            <div class="medium-6 columns"><img class="publish" src="http://placehold.it/500x300&text=[ad]"/></div>
        </div>
        
        <?php $this->load->view('web/vwMainMenu'); ?>
        
        <!-- Seccion Eventos -->
        <div class="row">
            <div class="eventos">
                
                
                 <!-- EVENTOS -->
                <?php
                $curMonth = -1;
                $lastMonth = -1;
                foreach ($dates as $date):
                    $curMonth = date('n', strtotime($date->date));
                    $lastMonth = $curMonth;  ?>

                    <div class="row dateRow" data-equalizer>
                        <div class="medium-1 columns eventLine" data-equalizer-watch>
                            <p>
                                <span><?php echo date('d', strtotime($date->date)); ?></span>
                                <br/><?php echo $minMonth[$curMonth]; ?>
                            </p>
                        </div>
                        <div class="medium-11 columns" data-equalizer-watch>
                            <?php 
                            $count = 0;
                            foreach ($date->events as $event): 
                                $count++; 
                                if($count>1){
                                    ?> <div class="rowBar"></div> <?php
                                }
                            ?>
                            
                                <div class="lblEvent" style="background: url('<?php echo base_url().IMG; ?>web/<?php echo $event->icon;?>') no-repeat;">
                                    <span class="lblEventTitle"><?php echo $event->torneo; ?></span><br/>
                                    <b><?php echo strtolower($event->time); ?></b>:  <?php echo $event->name; ?>
                                </div>
                                <div class="row">
                                    <?php foreach ($event->bars as $bar): ?>
                                        <div class="medium-4 columns">
                                            <img class="bars" src="<?php echo base_url().IMG; ?>app/sporttv/min/<?php echo $bar->image;?>" /></div>
                                    <?php endforeach;
                                    $xtra = count($event->bars)%3;
                                    for ($i = 1; $i <= $xtra; $i++) { ?>
                                        <div class="medium-4 columns">&nbsp;</div>
                                    <?php } ?>
                                </div>
                            
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
                <!-- Termina EVENTOS -->
                
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/sporttv.js"></script>
    </body>
</html>

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
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/eventos.css" />
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
            <?php foreach ($medioBanner as $item):?>
                <div class="medium-6 columns"><img class="publish" src="<?php echo base_url().IMG; ?>app/publicity/mediobanner/<?php echo $item->image;?>"/></div>
            <?php endforeach;?>
        </div>
        
        <?php $this->load->view('web/vwMainMenu'); ?>
        
        <!-- Seccion Eventos -->
        <div class="row">
            <div class="eventos">
                
                
                <!-- MESES -->
                <div class="row">
                    <div class="medium-11 columns">&nbspc;</div>
                    <div class="medium-1 columns">
                        <div id="menuMonth">
                        <?php
                        foreach ($months as $item):?>
                            <a class="circleLink" href="#month<?php echo $item; ?>"><div class="circleBase"><?php echo $item; ?></div></a>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <!-- Termina MESES -->
            
                <!-- DESTACADOS -->
                <?php foreach ($fav as $item):?>
                    <div class="row" data-equalizer>
                        <div class="medium-12 columns" data-equalizer-watch>
                            <div class="evento proxEvento boxShadow">
                                <div class="evntImg" style="background-image: url('<?php echo base_url().IMG; ?>app/event/min/<?php echo $item->image;?>');">
                                    <div class="evtContent content2">
                                        <p class="evtTitle1"><?php echo $item->name;?></p>
                                        <p class="evtTitle3 textDate">
                                            <?php echo date('d', strtotime($item->date)); ?> de 
                                            <?php echo $natMonth[date('n', strtotime($item->date))]; ?>
                                        </p>
                                        <p class="evtTitle2"><?php echo $item->place;?>, <?php echo $item->city;?>.</p>
                                        <img class="viewEvent" attr-id="<?php echo $item->id;?>" attr="<?php echo base_url().IMG; ?>app/event/max/<?php echo $item->image;?>" src="<?php echo base_url().IMG; ?>web/viewEvent.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <!-- Termina DESTACADOS -->


                 <!-- EVENTOS -->
                <?php
                $curMonth = -1;
                $lastMonth = -1;
                foreach ($available as $item):
                    $curMonth = date('n', strtotime($item->date));
                    if ($curMonth != $lastMonth){ ?>
                        <div id="month<?php echo $minMonth[$curMonth]; ?>" class="row titleMonth">
                            <p><?php echo $month[$curMonth]; ?> <b>
                            <?php echo date('Y', strtotime($item->date)); ?></b></p>
                        </div>
                    <?php 
                    } 
                    $lastMonth = $curMonth;  ?>

                    <div class="row" data-equalizer>
                        <div class="medium-1 columns eventLine" data-equalizer-watch>
                            <p>
                                <span><?php echo date('d', strtotime($item->date)); ?></span>
                                <br/><?php echo $minMonth[$curMonth]; ?>
                            </p>
                        </div>
                        <div class="medium-11 columns" data-equalizer-watch>
                            <div class="evento boxShadowLite <?php if ($item->fav == 1) {echo "proxEvento";} ?>">
                                <div class="evntImg2" style="background-image: url('<?php echo base_url().IMG; ?>app/event/min/<?php echo $item->image;?>');">
                                    <div class="evtContent subEvent">
                                        <p class="evtTitleMin1"><?php echo $item->name;?></p>
                                        <p class="evtTitleMin3"><?php echo $item->place;?>, <?php echo $item->city;?></p>
                                        <img class="viewEventMin" attr="<?php echo base_url().IMG; ?>app/event/max/<?php echo $item->image;?>" src="<?php echo base_url().IMG; ?>web/viewEvent.png">
                                    </div>
                                    <?php if ($item->fav == 1) { ?>
                                        <img class="eventSolapa" src="<?php echo base_url().IMG; ?>web/eventSolapa1.png">
                                    <?php } else { ?>
                                        <img class="eventSolapa" src="<?php echo base_url().IMG; ?>web/eventSolapa2.png">
                                    <?php } ?>
                                </div>
                            </div>
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
        <script type="text/javascript" src="<?php echo base_url().SHAPE; ?>js/snap.svg-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().SHAPE; ?>js/hovers.js"></script>
        <script type="text/javascript" src="<?php echo base_url().CAPTION; ?>js/toucheffects.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/eventos.js"></script>
    </body>
</html>
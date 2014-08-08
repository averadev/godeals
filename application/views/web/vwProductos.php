
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
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/productos.css" />
    </head>
    <body>
        
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
        
        <!-- Publicidad -->
        <div class="row publicidad">
            <div class="medium-6 columns"><img class="publish" src="http://placehold.it/500x300&text=[ad]"/></div>
            <div class="medium-6 columns"><img class="publish" src="http://placehold.it/500x300&text=[ad]"/></div>
        </div>
        
        <?php $this->load->view('web/vwMainMenu'); ?>
        
        <!-- Cupones -->
        <div class="cupones">
            <div class="row">
                <div class="medium-3 columns">
                    <div class="prodMenu">
                        <div class="maxMenu maxMenuSel">CATEGORIAS</div>
                        <div class="minMenu">
                            <p attr-id="0" class="<?php if(0 == $sel){echo 'minMenuSel';} ?>" >TODAS<span class="noCoupons"><?php echo $todas?></span></p>
                            <?php foreach ($elements as $item):
                                if($item->number > 0){?>  
                                    <p attr-id="<?php echo $item->id;?>" class="<?php if($item->id == $sel){echo 'minMenuSel';} ?>">
                                        <span><?php echo $item->name;?></span>
                                        <span class="noCoupons"><?php echo $item->number;?></span>
                                    </p>
                            <?php }
                            endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="medium-9 columns">
                    <ul class="cs-style-2">
                        <?php
                            $count = 0;
                            $limit = 4;
                            if ($total <  $limit){ $limit = $total;}
                            for ($i = 1; $i <= $limit; $i++) {
                            ?>
                                <li>
                                    <figure class="couponObj">
                                        <img  class="openModal"src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $coupons[$count]->image;?>">
                                        <figcaption>
                                            <h3><?php echo $coupons[$count]->description;?></h3>
                                            <span>
                                                <u class="linkPartner" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->partnerName;?></u> in 
                                                <u class="linkCity" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->cityName;?></u></span>
                                            <a class="openModal" attr-id="<?php echo $coupons[$count]->id;?>">Look</a>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php
                                $count++;
                            }
                        ?>
                    </ul>
                </div>
            </div>
            
            <?php 
            if ($total > 4){
                $pages = ($total - 4) / 8;
                $resto = ($total - 4) % 8;
                if ($resto > 0){
                    $pages = ($pages - ($resto / 8) + 1);
                }
                for ($z = 1; $z <= $pages; $z++) { ?>
                    <div class="row">
                        <div class="medium-3 columns">
                            <?php if ($z < $pages) { ?>
                                <img class="publish" src="http://placehold.it/300x840&text=[ad]"/>
                            <?php } else { ?>
                                &nbsp;
                            <?php } ?>
                        </div>
                        <div class="medium-9 columns">
                            <ul class="cs-style-2">
                                <?php
                                    $noCoupon = 8;
                                    if (($total - ($count)) < 8)
                                        $noCoupon = ($total - ($count)); 
                                    for ($i = 1; $i <= $noCoupon; $i++) {
                                    ?>
                                        <li>
                                            <figure class="couponObj">
                                                <img  class="openModal"src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $coupons[$count]->image;?>">
                                                <figcaption>
                                                    <h3><?php echo $coupons[$count]->description;?></h3>
                                                    <span>
                                                        <u class="linkPartner" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->partnerName;?></u> in 
                                                        <u class="linkCity" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->cityName;?></u></span>
                                                    <a class="openModal" attr-id="<?php echo $coupons[$count]->id;?>">Look</a>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    <?php
                                        $count++;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php if ($z < $pages) { ?>
                        <div class="row">
                            <div class="medium-3 columns">&nbsp;</div>
                            <div class="medium-9 columns">
                                <img class="cintillo" src="http://placehold.it/650x100&text=[ad]" />
                            </div>

                        </div>
                    <?php } ?>
                <?php 

                }    
            } ?>
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
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/productos.js"></script>
    </body>
</html>
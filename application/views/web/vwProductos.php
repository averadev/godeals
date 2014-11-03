
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().FOUND; ?>css/foundation.css" />
        <link rel="stylesheet" href="<?php echo base_url().SHAPE; ?>css/component.css" />
        <link rel="stylesheet" href="<?php echo base_url().CAPTION; ?>css/component.css" />
        <link rel="stylesheet" href="<?php echo base_url().MODAL; ?>jquery-impromptu.css" />
		<script type="text/javascript" src="<?php echo base_url().FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/productos.css" />
    </head>
    <body>
        
        <!-- Modal Cupones -->
        
                
        <?php $this->load->view('web/vwStickyMenu'); ?>
        
        
        <?php $this->load->view('web/vwHeader'); ?>
        
        <!-- Publicidad -->
        <div class="row publicidad">
            <?php foreach ($medioBanner as $item):?>
                <div class="medium-6 columns"><img class="publish" src="<?php echo base_url().IMG; ?>app/publicity/mediobanner/<?php echo $item->image;?>"/></div>
            <?php endforeach;?>
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
                                        <img  class="openModal" attr-id="<?php echo $coupons[$count]->id;?>" attr-description="<?php echo $coupons[$count]->description;?>" src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $coupons[$count]->image;?>">
                                        <figcaption>
                                            <h3><?php echo $coupons[$count]->description;?></h3>
                                            <span>
                                                <u class="linkPartner" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->partnerName;?></u>
                                            <a class="openModal" attr-id="<?php echo $coupons[$count]->id;?>" attr-description="<?php echo $coupons[$count]->description;?>"></a>
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
                $noLateral = 0;
                $noCintillo = 0;
                for ($z = 1; $z <= $pages; $z++) { ?>
                    <div class="row">
                        <div class="medium-3 columns">
                            <?php if ($z < $pages) { ?>
                                <img class="publish" src="<?php echo base_url().IMG; ?>app/publicity/lateral/<?php echo $lateral[$noLateral]->image;?>"/>
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
                                                <img  class="openModal" attr-id="<?php echo $coupons[$count]->id;?>" attr-description="<?php echo $coupons[$count]->description;?>" src="<?php echo base_url().IMG; ?>app/coupon/min/<?php echo $coupons[$count]->image;?>">
                                                <figcaption>
                                                    <h3><?php echo $coupons[$count]->description;?></h3>
                                                    <span>
                                                        <u class="linkPartner" attr-id="<?php echo $coupons[$count]->partnerId;?>"><?php echo $coupons[$count]->partnerName;?></u>
                                                    <a class="openModal" attr-id="<?php echo $coupons[$count]->id;?>" attr-description="<?php echo $coupons[$count]->description;?>"></a>
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
                                <img class="cintillo" src="<?php echo base_url().IMG; ?>app/publicity/cintillo/<?php echo $cintillo[$noCintillo]->image;?>" />
                            </div>

                        </div>
                    <?php } ?>
                <?php
                    $noLateral++;
                    if ($noLateral == count($lateral)){ $noLateral = 0; }
                    $noCintillo++;
                    if ($noCintillo == count($cintillo)){ $noCintillo = 0; }
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
        <script type="text/javascript" src="<?php echo base_url().MODAL; ?>jquery-impromptu.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/api/hachiko/hachiko.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>web/productos.js"></script>
    </body>
</html>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url() . FOUND; ?>css/foundation.css" />
        <script type="text/javascript" src="<?php echo base_url() . FOUND; ?>js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/home.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>web/faq.css" />
    </head>
    <body>

        <!-- Modal Cupones -->

        <?php $this->load->view('web/vwStickyMenu'); ?>


        <?php $this->load->view('web/vwHeader'); ?>

        <?php $this->load->view('web/vwMainMenu'); ?>
        <br/>
        <div class="row">
            <div class="large-12 columns">
                <h1  class="text-center">FAQ GO DEALS</h1>
            </div>
            <hr>
        </div>
        <br/><br/>


        <div class="preguntas">
            <div class="row">
                <div class="large-12 columns">
                    
                    <ul class="tabs vertical" data-tab>
                        <li><div class="maxMenu maxMenuSel">Temas</div></li> 
                        <li class="active temaMenu temaMenuSel"><a href="#panel1a">Tema 1</a></li> 
                        <li class="temaMenu temaMenuSel"><a href="#panel2a">Tema 2</a></li>
                        <li class="temaMenu temaMenuSel"><a href="#panel3a">Tema 3</a></li> 
                    </ul>
                     
                    <div class="tabs-content vertical"> 
                        <div class="content active" id="panel1a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation clearfix">    
                                    <a href="#panel1" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 1</a>                        
                                    <div id="panel1" class="content active">
                                    <p class="respuesta">Respuesta 1</p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 2</a> 
                                    <div id="panel2" class="content">
                                        <p class="respuesta">Respuesta 2</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 3</a> 
                                    <div id="panel3" class="content">
                                        <p class="respuesta">Respuesta 3.</p>
                                    </div> 
                                </dd>
                                <br/>
                            </dl>
                        </div> 
                        <div class="content" id="panel2a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation "> 
                                    <a href="#panel1b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 1b</a> 
                                    <div id="panel1b" class="content">
                                    <p class="respuesta">Respuesta 1b</p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 2b</a> 
                                    <div id="panel2b" class="content">
                                        <p class="respuesta">Respuesta 2b</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 3b</a> 
                                    <div id="panel3b" class="content">
                                        <p class="respuesta">Respuesta 3b.</p>
                                    </div> 
                                </dd>
                                <br/>
                            </dl>
                        </div> 
                        <div class="content" id="panel3a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation "> 
                                    <a href="#panel1c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 1c</a> 
                                    <div id="panel1c" class="content">
                                    <p class="respuesta">Respuesta 1c</p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 2c</a> 
                                    <div id="panel2c" class="content">
                                        <p class="respuesta">Respuesta 2c</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Pregunta 3c</a> 
                                    <div id="panel3c" class="content">
                                        <p class="respuesta">Respuesta 3c.</p>
                                    </div> 
                                </dd>
                                <br/>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear">
            <br/><br/>
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
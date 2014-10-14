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
                        <li><div class="maxMenu maxMenuSel">TEMAS</div></li> 
                        <li class="active temaMenu temaMenuSel"><a href="#panel1a"> REGISTRO</a></li> 
                        <li class="temaMenu temaMenuSel"><a href="#panel2a">MI CUENTA</a></li>
                        <li class="temaMenu temaMenuSel"><a href="#panel3a">PLATAFORMA GODEALS</a></li>
                        <li class="temaMenu temaMenuSel"><a href="#panel4a">COMERCIOS</a></li> 
                    </ul>
                     
                    <div class="tabs-content vertical"> 
                        <div class="content active" id="panel1a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation clearfix">    
                                    <a href="#panel1" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Tiene alg&uacute;n costo registrarse en Go Deals?</a>                        
                                    <div id="panel1" class="content active">
                                    <p class="respuesta"> No, tanto la afiliaci&oacute;n a Go Deals, como la aplicaci&oacute;n m&oacute;vil son completamente gratuitas.
</p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Como me registro en Go Deals?</a> 
                                    <div id="panel2" class="content">
                                        <p class="respuesta">Puede hacerlo a trav&eacute;s de la opci&oacute;n “Registrate” en nuestro sitio web, o bien, directamente en la aplicaci&oacute;n m&oacute;vil. En ambos casos &uacute;nicamente necesitas un correo electr&oacute;nico y escoger la contrase&ntilde;a que desees.</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Que beneficios obtengo al registrarme?</a> 
                                    <div id="panel3" class="content">
                                        <p class="respuesta">Al momento de ser un usuario registrado, tendr&aacute;s acceso a nuestra aplicaci&oacute;n m&oacute;vil con toda la informaci&oacute;n de nuestra plataforma, podr&aacute;s seleccionar las ofertas que te interesen para tenerlas siempre accesible en tu tel&eacute;fono, acceso al mapa con los comercios cercanos, adem&aacute;s de enterarte semanalmente de los pr&oacute;ximos eventos y nuevas ofertas en tu ciudad.</p>
                                    </div> 
                                </dd>
                                <br/>
                            </dl>
                        </div> 
                        <div class="content" id="panel2a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation "> 
                                    <a href="#panel1b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Olvide mi contrase&ntilde;a...</a> 
                                    <div id="panel1b" class="content">
                                    <p class="respuesta">¡Nos pasa a todos! En caso de no recordar tu contrase&ntilde;a, puedes seleccionar la opci&oacute;n de “Olvide mi contrase&ntilde;a” que se encuentra en el m&oacute;dulo de registro tanto de nuestro sitio web como de nuestra aplicaci&oacute;n m&oacute;vil. La contrase&ntilde;a debe de ser enviada al correo que tienes registrado.</p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;No me deja agregar a favoritos unas ofertas publicadas...</a> 
                                    <div id="panel2b" class="content">
                                        <p class="respuesta">Para poder agregar a tu cuenta ofertas y promociones, forz&oacute;samente debes de estar firmado en la aplicaci&oacute;n, para lo cual debes de estar pr&eacute;viamente registrado como usuario Go Deals.</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3b" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;He agregado a favoritos cupones en su sitio web, ¿como los puedo consultar?</a> 
                                    <div id="panel3b" class="content">
                                        <p class="respuesta">Todas las ofertas y promociones que te interesen y marques como favorito en nuestro sitio web, estar&aacute;n disponibles en la sección de “Favoritos” que se encuentra en la parte superior derecha tanto de tu aplicaci&oacute;n m&oacute;vil como de nuestro sitio web una vez que te encuentres firmado a la aplicaci&oacute;n.</p>
                                    </div> 
                                </dd>
                                <br/>
                            </dl>
                        </div> 
                        <div class="content" id="panel3a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation "> 
                                    <a href="#panel1c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Que puedo encontrar en cada secci&oacute;n de Go Deals?</a> 
                                    <div id="panel1c" class="content">
                                    <p class="respuesta">La plataforma esta dividida en secciones principales, las cuales a su vez, se sub dividen en categor&iacute;as. Las secciones que puedes encontrar son:<br/>
a) Eventos: Te da la informaci&oacute;n de los próximos eventos que habr&aacute; en tu ciudad, incluyendo eventos musicales, deportivos, art&iacute;sticos, etc&eacute;tera.<br/>
b) Entretenimiento: Te informa de las mejores ofertas para divertirte en tu ciudad, inluyendo Restaurantes, bares, discos, tours, entre otros.<br/>
c) Productos y servicios: Las mejores ofertas y promociones en diversos productos y servicios de tu ciudad. Consultalos por categor&iacute;a.<br/>
d) Sport TV: ¿Te vas a reunir con tus amigos para ver la transmisi&oacute;n de un evento deportivo? Ent&eacute;rate aqu&iacute; los lugares que lo transmitir&aacute;n y las ofertas que te ofrece cada uno.<br/>
e) A donde ir: Gu&iacute;a informativa para conocer lugares de inter&eacute;s en Cancun, Riviera Maya y Cozumel. </p>
                                    </div> 
                                </dd> 
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel2c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Me interesaron ofertas que publicaron, ¿Como obtengo el cup&oacute;n correspondiente?</a> 
                                    <div id="panel2c" class="content">
                                        <p class="respuesta">Los cupones que te interesen los puedes obtener de las siguientes maneras a trav&eacute;s de nuestra p&aacute;gina web o aplicaci&oacute;n m&oacute;vil:<br/><br/>

a) Puedes descargarte el cup&oacute;n directamente a tu aplicaci&oacute;n m&oacute;vil mediante la opci&oacute;n “Agregar” que aparece en el detalle del cup&oacute;n.<br/>
b) Si lo prefieres, puedes enviartelo con correo mediante la opci&oacute;n “Enviar a mi correo” que aparece en el cup&oacute;n.<br/>
c) Puedes seleccionar la opci&oacute;n de imprimir para llev&aacute;rtelo f&iacute;sicamente. (&Uacute;nicamente en nuestro sitio web)<br/></p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel3c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Como descargo la aplicaci&oacute;n de Go Deals para mi tel&eacute;fono?</a> 
                                    <div id="panel3c" class="content">
                                        <p class="respuesta">La aplicaci&oacute;n de Go Deals es completamente gratuita y esta disponible para Android a trav&eacute;s de Google Play y iOS a trav&eacute;s de la App Store
</p>
                                    </div> 
                                </dd>
                                <br/>
                                <dd class="accordion-navigation"> 
                                    <a href="#panel4c" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;¿Para que plataformas esta disponible la aplicaci&oacute;n Go Deals?</a> 
                                    <div id="panel4c" class="content">
                                        <p class="respuesta">Por el momento &uacute;nicamente para Android y iOS de Apple.
</p>
                                    </div> 
                                </dd>
                            </dl>
                        </div>
                        
                        
                         <div class="content" id="panel4a"> 
                            <dl class="accordion" data-accordion> 
                                <dd class="accordion-navigation "> 
                                    <a href="#panel1d" class="label radius text-left"><img  height="20" width="20" src="<?php echo base_url().IMG; ?>web/btnPlus.png" />&nbsp;&nbsp;Quiero Afiliar mi comercio a su plataforma, ¿C&uacute;al es el procedimiento?</a> 
                                    <div id="panel1d" class="content">
                                    <p class="respuesta">Para contact&aacute;rnos, por favor env&iacute;anos un correo por medio del formulario de contacto, para a la brevedad, concertar una reuni&oacute;n y platicar las opciones que tenemos y escoger as&iacute; la que mejor se adeque a tu negocio.</p>
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

<!doctype html>
<html class="no-js" lang="en" style="background: url('<?php echo base_url().IMG; ?>prox/bgHeader.png');">
    <head>
        <meta charset="utf-8">
        <title>Go Deals</title>
        <link media="screen" href="<?php echo base_url().IMG; ?>prox/msg/jquery.msg.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>web/proximamente.css" />
        <link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
        
        
    </head>
    <body>
        <div class="header">
            <center><div id="logo-header"></div></div> </center>
        </div>
        <div class="contenido">
            <div class="text registro">
                <img src="<?php echo base_url().IMG; ?>prox/registrate.png" style="padding-left: 60px;">
                <input type="text" id="email" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email" />
                <input type="password" id="contrasenia" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password" />
                <input type="password" id="contraseniaRe" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repetir Password" />
                <div id="btnEnviar">Enviar</div>
            </div>
        </div>
        <div class="footer">
            <div id="footer-buttons">
                <img src="<?php echo base_url().IMG; ?>prox/eventos.png" class="boton-footer"/>
                <img src="<?php echo base_url().IMG; ?>prox/entre.png" class="boton-footer" />
                <img src="<?php echo base_url().IMG; ?>prox/compras.png" class="boton-footer"/>
                <img src="<?php echo base_url().IMG; ?>prox/dondeir.png" class="boton-footer" style="margin-right: 0;"/>
                <center>
                    <div id="footer-buttonsMenu">
                    <div class="footer-buttons-tit" id="footer-buttons-tit-1">EVENTOS</div>
                    <div class="footer-buttons-tit" id="footer-buttons-tit-2">ENTRETENIMIENTO</div>
                    <div class="footer-buttons-tit" id="footer-buttons-tit-3">PRODUCTOS Y SERVICIOS</div>
                    <div class="footer-buttons-tit" id="footer-buttons-tit-4">DONDE IR</div>
                    </div>
                </center>
            </div>
            
            <div id="footer-legend">
                DERECHOS RESERVADOS 2014 &nbsp;&nbsp;&nbsp;<img src="<?php echo base_url().IMG; ?>prox/logo.png" style="height: 41px;vertical-align: middle;"> &nbsp;&nbsp;&nbsp;CANCÚN, QUINTANA ROO, MÉXICO
            </div>
            
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().IMG; ?>prox/msg/jquery.center.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().IMG; ?>prox/msg/jquery.msg.js"></script>
    </body>
</html>

<script>
      
    $(function() {
        $('#btnEnviar').click(function() {
            if ($('#email').val() == '' || 
                $('#contrasenia').val() == '' || 
                $('#contraseniaRe').val() == ''){
                $.msg({ content : 'Es necesario completar todos los campos.' });
            }else if ($('#contrasenia').val() != $('#contraseniaRe').val()){
                $.msg({ content : 'Las contraseñas no coinciden.' });
            }else{
                $.post('proximamente/registro',{
                    'email'	: $('#email').val(),
                    'password'	: $('#contrasenia').val()
                    },function(jsonData) {
                        $.msg({ content : jsonData.message });
                    },
                "json");
            }
        });
    });
    
</script>
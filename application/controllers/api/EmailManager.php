
<?php

/**
 * Componente encargado del envio de Correos
 *
 * @author     Alberto Vera Espitia <avera@geekbucket.com.mx>
 * @copyright  2013 GeekBucket
 * @version    SVN: $Id$
 *
 */

class EmailManager {

    function preRegisterEmail($emailTo, $password){
    	
        // título
        $título = 'Confirmación de Registro';

        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:80px; background: #212121 url(http://godeals.mx/assets/img/prox/logoGo.png) no-repeat center left; font-size:50px; color:#ffffff; padding: 20px 0 0 250px; ">
                    BIENVENIDO
                </div>
                <div style="width:100%; height:5px; background: #5ec62b;"></div>

                <div style="width:100%; margin: 20px 0;">
                    <h3>CONFIRMACI&Oacute;N DE REGISTRO</h3>

                    <p style="font-family:Georgia; font-size:18px;">Gracias por registrarte en Go deals, tu guia para saber a donde ir, que hacer y donde obtener los mejores descuentos de tu ciudad.</p>

                    <p style="font-family:Georgia; font-size:18px;">Apartir del 4 de Septiembre puedes acceder por medio de nuestro sitio web <a href="www.godeals.mx">www.godeals.mx</a> o mediante nuestras aplicaciones moviles con tu usuario y password.</p>

                    <p style="font-family:Georgia; font-size:18px;">USUARIO: '.$emailTo.' 
                    <br/>PASSWORD: '.$password.' 
                    </p>
                </div>

                <div style="width:100%; height:5px; background: #5ec62b;"></div>
                <div style="width:100%; height:60px; background: #212121; font-size:18px; font-weight: bold; color:#ffffff;">
                    <div style="margin-left: 10px; display: inline-block; line-height: 60px; width:400px; background: url(http://godeals.mx/assets/img/prox/logoWhiteMail.png) no-repeat center right;">DERECHOS RESERVADOS 2014</div>
                    <div style="margin-left: 10px; display: inline-block; line-height: 60px;">CANCUN QUINTANA ROO MEXICO</div>
                </div>
            </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Contacto Godeals <contacto@godeals.mx>';

        // Enviarlo
        mail($emailTo, $título, $mensaje, $cabeceras);
    }
    
    function contactEmail($name, $email, $subject, $mesage){
    	
        // título
        $título = 'Contacto: '.$subject;

        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:80px; background: #212121 url(http://godeals.mx/assets/img/prox/logoGo.png) no-repeat center left; font-size:50px; color:#ffffff; padding: 20px 0 0 250px; ">
                    Contacto
                </div>
                <div style="width:100%; height:5px; background: #5ec62b;"></div>

                <div style="width:100%; margin: 20px 0;">
                    <h3>'.$subject.'</h3>

                    <p style="font-family:Georgia; font-size:18px;">'.$mesage.'</p>

                </div>

                <div style="width:100%; height:5px; background: #5ec62b;"></div>
                <div style="width:100%; height:60px; background: #212121; font-size:18px; font-weight: bold; color:#ffffff;">
                    <div style="margin-left: 10px; display: inline-block; line-height: 60px; width:400px; background: url(http://godeals.mx/assets/img/prox/logoWhiteMail.png) no-repeat center right;">DERECHOS RESERVADOS 2014</div>
                    <div style="margin-left: 10px; display: inline-block; line-height: 60px;">CANCUN QUINTANA ROO MEXICO</div>
                </div>
            </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: '.$name.' <'.$email.'>';

        // Enviarlo
        mail('avera@geekbucket.com.mx, mzuniga@geekbucket.com.mx', $título, $mensaje, $cabeceras);
    }
}

?>
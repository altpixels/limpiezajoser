<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LcPx9IUAAAAAOxE_a9V8HMdTnmONEo6hiGVZG7i',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!

        $vnombre=$_POST['nombre'];
        $vtel=$_POST['telefono'];
        $vcel=$_POST['celular'];
        $vemail=$_POST['correo'];
        $vcoment=$_POST['comentario'];
        if(($vnombre!="")&&($vtel!="")&&($vcel!="")&&($vemail!="")&&($vcoment!="")){

            $asunto="";
            $asunto="Mensaje desde limpiezajoser.com";
            $headers="";
            $headers="Content-type: text/html; charset=UTF-8\r\n"; //para el envío en formato HTML 
            $headers.="MIME-Version: 1.0\r\n"; 
            $headers.="From:".$vnombre."<".$vemail.">\r\n";
            $cuerpo="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
                         <html>
                            <body>
                                <table style='color: #063f84; font-family: verdana'>
                                    <tr>
                                        <td>Nombre:
                                        </td>
                                        <td>".$vnombre."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telefono:
                                        </td>
                                        <td>".$vtel."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Celular:
                                        </td>
                                        <td>".$vcel."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Correo:
                                        </td>
                                        <td>".$vemail."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>Comentario:
                                        </td>
                                        <td>".$vcoment."
                                        </td>
                                    </tr>
                                </table>
                            </body>
                        </html>";

        mail("azaelv85@gmail.com",$asunto,$cuerpo,$headers);

        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
        }
    }
} else { ?>
    
<!-- FORM GOES HERE -->
<form></form>


<!--$vnombre=$_POST['nombre'];
$vtel=$_POST['telefono'];
$vcel=$_POST['celular'];
$vemail=$_POST['correo'];
$vcoment=$_POST['comentario'];
if(($vnombre!="")&&($vtel!="")&&($vcel!="")&&($vemail!="")&&($vcoment!="")){

    $asunto="";
    $asunto="Mensaje desde limpiezajoser.com";
    $headers="";
    $headers="Content-type: text/html; charset=UTF-8\r\n"; //para el envío en formato HTML 
    $headers.="MIME-Version: 1.0\r\n"; 
    $headers.="From:".$vnombre."<".$vemail.">\r\n";
    $cuerpo="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
                 <html>
                    <body>
                        <table style='color: #063f84; font-family: verdana'>
                            <tr>
                                <td>Nombre:
                                </td>
                                <td>".$vnombre."
                                </td>
                            </tr>
                            <tr>
                                <td>Telefono:
                                </td>
                                <td>".$vtel."
                                </td>
                            </tr>
                            <tr>
                                <td>Celular:
                                </td>
                                <td>".$vcel."
                                </td>
                            </tr>
                            <tr>
                                <td>Correo:
                                </td>
                                <td>".$vemail."
                                </td>
                            </tr>
                            <tr>
                                <td valign='top'>Comentario:
                                </td>
                                <td>".$vcoment."
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>";

    mail("azaelv85@gmail.com",$asunto,$cuerpo,$headers);
    header("location: https://limpiezajoser.com/agradecimiento.html");
    
    }
        else{
            header("location: https://limpiezajoser.com.mx/errorenvio.html");
        }
    /*else if($cuenta=="comercial"){
        if(mail("d.chavez@buxisgroup.com",$asunto,$cuerpo,$headers)){
           header("location: http://buxisgroup.com/agradecimiento.html");
        }
        else{
            echo"Ocurrio un error al enviar el comentario";
        }
    }
    else if($cuenta==""){
            echo"Especifique el tipo de información (técnica o comercial)";
    }*/
?>

<?php } ?>
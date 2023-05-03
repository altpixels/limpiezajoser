<?php 
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
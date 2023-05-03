<?php
$vnombre=$_POST['nombre'];
$vtel=$_POST['telefono'];
$vcel=$_POST['celular'];
$vemail=$_POST['correo'];
$vcoment=$_POST['comentario'];

	if(isset($_POST['enviar'])&&($vnombre!="")&&($vtel!="")&&($vcel!="")&&($vemail!="")&&($vcoment!="")) {
		//print_r($_POST);
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6LcdDNcUAAAAABWyDGKwjeyPpfAgimBBKjuEHWt7",
			'response' => $_POST['token'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data)

			)
		);

		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);

		if ($res['success'] == true) {
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

		    mail("contacto@limpiezajoser.com",$asunto,$cuerpo,$headers);
		    header("location: https://limpiezajoser.com/agradecimiento.html");

		} else {
			header("location: https://limpiezajoser.com/errorenvio.html");
		}

	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 TransiTIonal//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Actualizar Registros</title>
    <style type="text/css">
	.boton {
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 11px;
	    font-weight: normal;
	    background-color:#e0e0e0; 
	    font-variant: small-caps;
	    height: 20px;
	    padding: 0px;
	}
        .datospf {
	    text-align: left; 
	    font-family:Arial; 
	    font-size: 11px;
	    font-weight: normal;
	    background-color:#FFFFFF; 
	    border-style: solid;
	    border-width: 1px;
	    border-color: #96BBF3;
        }
        .enc_p {
	    color:#FFFFFF;
	    text-align: center; 
	    font-family:Helvetica;
	    font-size: 14px;
	    font-weight: bold;
	    background-color:#3366CC;
	    height:20px;
	    font-variant: small-caps;
        }
        .datosp {
	    text-align: left; 
	    font-family:Arial; 
	    font-size: 12px;
	    font-weight: normal; 
	    font-variant: small-caps;
        }
        .datosc {
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px;
	    font-weight: normal; 
	    font-variant: small-caps;
        }
        .act { 
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px; 
	    font-weight: normal;
	    background-color:#99CCFF;
	}
	.dp {
	    text-align: left; 
	    font-family: Arial; 
	    font-size: 11px;
	    font-weight: normal;
	    background-color: #FFFFFF; 
	    font-variant: small-caps;
	}	
	.titulo {
	    text-align: center; 
	    font-family:Arial; 
	    font-size: 12px; 
	    font-weight: normal;
	    background-color: #FFFFFF; 
	    margin-top:0;
	    margin-bottom:0;	
	    font-variant: small-caps;
	}
	.tituloc {
	    font-family: Calibri; 
	    font-size: 18px;
	    text-align:center;
	    font-weight: bold;
	    color: #203C59;
	}
    </style>
</head>
<body>
	<form name="Solicitud" action="actualizarlisto.php" method="post" onSubmit="return validar(this)">
	    <table border="0px" align="center">
		<tr>
		    <td colspan="5" align="center">	
			<table border="0" width="600">
			    <tr>
				<td width="50">
				    <p align="right" style="margin-top: 0; margin-bottom: 0">
					<img border="0" src="images/unex15.gif" width="75" height="75">
				    </p>
				</td>
				<td width="500">
			            <p class="titulo">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulo">"ANTONIO JOSE DE SUCRE"</p>
				    <p class="titulo">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulo">ASIGNATURA TRABAJO DE GRADO Y PRÁCTICA PROFESIONAL</font>
				</td>
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr>
		<tr><td colspan="5"><font style="font-size:100px;">&nbsp;</font></td></tr>
		</tr>
		<?
			$destinatario = "santiago.jzc@gmail.com";
			$asunto = "Este mensaje es de prueba";
			$cuerpo = '
			<html>
			<head>
			<title>Prueba de correo</title>
			</head>	
			<body>	
			<h1>Hola amigos!</h1>
			<p>
			<b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje.
			</p>
			</body>
			</html>
			';
			
			//dirección del remitente
			$headers= "From: Coordinador Trabajo de Grado y Práctica Profesional <annel3004@gmail.com>\r\n";
			
			mail($destinatario,$asunto,$cuerpo,$headers)
			?>
		<tr>
			<td>
			<div class="tituloc" align=center>Su mensaje ha sido enviado exitosamente!<br></div>
			</td>
			<td>
			</td>
		</tr>
		<tr align=center>
		    <table align="center" border="0" width=40%>
			<tr><td colspan="5"><font style="font-size:20px;">&nbsp;</font></td></tr>
			<tr>
				<td align="center" valign="bottom" colspan="1">
				<input type="button" value="Finalizar" name="bexit" onclick="window.close();">
				</td>
			</tr>
		    </table>
		</tr>
	    </table>
	</form>
</body>	

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Registro de Estudiante</title>
    <style type="text/css">
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
	.mat {
	    text-align: center; 
	    font-family: Arial; 
	    font-size: 11px; 
	    font-weight: normal;
	    color: black;
	    vertical-align: top;
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
    </style>  
</head>
<body>
    <?php
    include_once('inc\config.php');
	session_start();
	$conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
	$sql="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$_SESSION[cedula]'";
	$registros = odbc_exec($conexion, $sql)or die ("Problemas en el select");
    ?>
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
				    <p class="titulo">ASIGNATURA PRÁCTICA PROFESIONAL</font>
				</td>
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
	        <tr><td class="enc_p" colspan="5">DATOS DEL ESTUDIANTE</td></tr>
		<tr align="center">
		    <td colspan="5">
		        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
			        <tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<?php
				if ($reg = odbc_fetch_array($registros))
				    {
				    printf('<tr>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td></tr>',$reg["APELLIDOS"],$reg["NOMBRES"],$_SESSION["cedula"]);
				?>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp"><B>Expediente:</B></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp"><B>Especialidad:</B></div></td>
				    <td bgcolor="#FFFFFF" colspan="3"><div class="datosp"><B>Estatus:</B></div></td>
				</tr>
				<?php
				    $sql1="select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'";
				    $esp = odbc_exec($conexion, $sql1)or die ("Problemas en el select");
				        if ($espe = odbc_fetch_array($esp))
					    {
					    printf('<tr>
					        <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
					        <td bgcolor="#FFFFFF"><div class="datosp">INGENIERÍA %s</div></td></td>',$reg["EXP_E"],$espe["CARRERA"]);
					    }
					$conexion1 = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
					$sql2="select empresa, n_proyecto, cedula_ti, nombre_ti, apellido_ti, telefono_ti, correo_ti, fecha_i, fecha_c, fecha_l, estatus, cedula_TA, cedula_JC, cedula_JS from sol_tgpp where cedula_e = '$_SESSION[cedula]'";
					$datos = odbc_exec($conexion1, $sql2)or die ("Problemas en el select");
					    if ($datostp = odbc_fetch_array($datos))
						{
						printf('
						    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td></tr>',$datostp["estatus"]);
						}
				    }
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>
		<tr>
		    <td colspan="5">
		        <table width="100%">
			    <tbody>
				<tr>
				    <td style="text-align: center;" class="datosp">
					<strong>Empresa</strong>
				    </td>
				</tr>
				<tr>
					<?php
					    printf(
						'<td style="text-align: center;" nowrap="nowrap" bgcolor="#FFFFFF" class="mat">%s</td>'
						, $datostp["empresa"]);
					?>
				    </td>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td width="60%" style="text-align: center;" class="datosp">
					<strong>Nombre del Proyecto:</strong>
				    </td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td style="width: 300px;" style="text-align: center;" bgcolor="#FFFFFF" class="mat">%s</td>'
					    , $datostp["n_proyecto"]);
				    ?>
				</tr>						
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="1" cellspacing="1" width="80%" style="border-collapse: collapse;">
			    <tbody  valign="center">
				<tr>			    
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Inicio:</strong>
				    </td>
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha de Culminaci&oacute;n:</strong>
				    </td>
				    <td width="30%" style="text-align: center;" class="datosp">
					<strong>Fecha L&iacute;mite:</strong>
				    </td>				    
				</tr>
				<tr>
					<?php
					    printf(
					      '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
					      <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>
					      <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>', $datostp["fecha_i"], $datostp["fecha_c"], $datostp["fecha_l"]);
					?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL TUTOR INDUSTRIAL</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$datostp["apellido_ti"],$datostp["nombre_ti"],$datostp["cedula_ti"]);
				    ?>
				</tr>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Teléfono:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Correo:</B></div></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>			      
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$datostp["telefono_ti"],$datostp["correo_ti"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		if ($datostp['estatus']=="APROBADO" && $datostp['cedula_TA']!="")
		    {
		    $conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
		    $sql3="select APELLIDO, NOMBRE from tblaca007 where CI = '$datostp[cedula_TA]'";
		    $asc = odbc_exec($conexion, $sql3)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($asc)) 
			{
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL TUTOR ACAD&Eacute;MICO</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$datostp["cedula_TA"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
			}
		    }
		if ($datostp['estatus']=="APROBADO" && $datostp['cedula_JC']!="" && $datostp['cedula_JS']!="")
		    {
		    $sql4="select APELLIDO, NOMBRE from tblaca007 where CI = '$datostp[cedula_JC]'";
		    $asc = odbc_exec($conexion, $sql4)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($asc)) 
			{
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL JURADO COORDINADOR</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$datostp["cedula_JC"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
			}
		    $sql5="select APELLIDO, NOMBRE from tblaca007 where CI = '$datostp[cedula_JC]'";
		    $asc = odbc_exec($conexion, $sql5)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($asc)) 
			{
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL JURADO SECRETARIO</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <?php
					printf(
					    '<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$datostp["cedula_JS"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
			}
		    }
		?>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>		
		<tr align=center>
		    <table align="center" border="0" width=40%>
			<tr>
			    <form action="">
				<td align="center" valign="bottom" colspan="1">
				    <input type="button" value="Finalizar" name="bexit" onclick="window.close();">
				</td>
			    </form>
			</tr>
		    </table>
		</tr>
	    </table>
</body>
</html>
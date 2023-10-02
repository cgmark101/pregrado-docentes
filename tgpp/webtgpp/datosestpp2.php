<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Consulta de Datos</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <script languaje="Javascript">
    <!--
    Estudiante = '';        var Imprimio = false;
    function imprimir(fi) {
	with (fi) {
	    bimp.style.display="none";
            bexit.style.display="none";
            window.print();
            Imprimio = true;
            msgI = Estudiante + ':\nSi mandaste a imprimir tu planilla\n';
            msgI = msgI + "pulsa el botón 'Finalizar' y ve a retirar tu planilla por la impresora,\n";
            msgI = msgI + 'de lo contrario vuelve a pulsar Imprimir\n';
            //alert(msgI);
            bimp.style.display="block";
            bexit.style.display="block";
        }
    }
    function verificarSiImprimio(){
        window.status = Estudiante + ': NO TE VAYAS SIN IMPRIMIR TU PLANILLA';
        if (Imprimio){
            window.close();
        }
        else {
            msgI = '            ATENCION!\n' + Estudiante;
            alert(msgI +':\nNo te vayas sin imprimir tu planilla');
	    Imprimio = true;
        }
    }
    <!--
    document.writeln('</font>');
    //-->
    </script>
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
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOSE DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulon">ASIGNATURA PRÁCTICA PROFESIONAL</font>
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
				    }
					$conexion1 = odbc_connect($DSN2, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
					$sql2="select * from sol_tgpp where CI_E = '$_SESSION[cedula]' and TIPO_PASANTIA=1";
					$tabla = odbc_exec($conexion1, $sql2)or die ("Problemas en el select");
					    if ($tab = odbc_fetch_array($tabla))
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
						, $tab["empresa"]);
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
					    , $tab["n_proyecto"]);
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
					      <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="mat">%s</td>', $tab["fecha_i"], $tab["fecha_c"], $tab["fecha_l"]);
					?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>		
		<?php
		    $sql3="select * from sol_estatus where id_estatus='$tab[id_estatus]'";
		    $stats = odbc_exec($conexion1, $sql3)or die ("Problemas en el select");
		    if ($stat = odbc_fetch_array($stats))
		    {
			printf('<tr><td align="center" bgcolor="#FFFFFF" colspan="5"><div class="datosc"><B>Estado de Solicitud:</B></div></td></tr>
			       <tr><td align="center" bgcolor="#FFFFFF"><div class="datosc">%s</div></td></tr>',$stat["estatus"]);
		    }
		?>
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
						<td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$tab["apellido_TI"],$tab["nombre_TI"],$tab["cedula_TI"]);
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
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$tab["telefono_TI"],$tab["correo_TI"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		if ($tab['id_estatus']==2 && $tab['cedula_TA']!="")
		    {
		    $conexion = odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión"); 	
		    $sql4="select APELLIDO, NOMBRE from tblaca007 where CI = '$tab[cedula_TA]'";
		    $profesores = odbc_exec($conexion, $sql4)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($profesores)) 
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
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_TA"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
			}
		    }
		if ($tab['id_estatus']==2 && $tab['cedula_JC']!="" && $tab['cedula_JS']!="")
		    {
		    $sql5="select APELLIDO, NOMBRE from tblaca007 where CI = '$tab[cedula_JC]'";
		    $profesores = odbc_exec($conexion, $sql5)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($profesores)) 
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
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_JC"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
			}
		    $sql6="select APELLIDO, NOMBRE from tblaca007 where CI = '$tab[cedula_JS]'";
		    $profesores = odbc_exec($conexion, $sql6)or die ("Problemas en el select");
		    if ($prof = odbc_fetch_array($profesores)) 
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
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosp">%s</td>',$prof["APELLIDO"],$prof["NOMBRE"],$tab["cedula_JS"]);
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
				<form name="imprime" action="">
				    <td valign="bottom">
				        <p align="center"><input type="button" value=" Imprimir " name="bimp" style="background:#FFFF33;
					    color:black; font-family:arial; font-weight:bold;" onclick="imprimir(document.imprime)">
					</p> 
				    </td>
				    <td valign="bottom">
					  <p align="center"><input type="button" value="Finalizar" name="bexit" onclick="window.close();"></p> 
				    </td>
				</form>
			</tr>
		    </table>
		</tr>
	    </table>
</body>
</html>
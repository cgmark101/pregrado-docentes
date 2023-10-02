<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css"/>
    <script language='javascript' src='js/validar.js'></script>
    <script language='javascript' src='popcalendar.js'></script>
    <title>Ver Historial</title>
    <script language=javascript>
    function fechaC(){
    var fecha = document.getElementById('dateArrival').value
    var day = parseInt(fecha.substr(0,2));
    var month = parseInt(fecha.substr(3,2));	
    var year = parseInt(fecha.substr(6,4));
    var fechac=0;
    if (day<10) day='0'+day;
    if (month<10) month='0'+month; 
    year=year+1;
    fechacul = day +"-"+ month +"-"+ year;
    document.getElementById('dateArrival1').value = fechacul
   }
   </script> 
    <script language=javascript>
    function tutor(){
    document.getElementById('cedula_DS').value  = document.getElementById('cedula_TA').value
   }
    </script> 
</head>
<body>
    <?php
    include_once('conexion.php');
	$sql="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA from dace002 where CI_E = '$_REQUEST[id]'";
	$conex -> ExecSQL($sql,__LINE__,true);
	$fila1 = $conex->filas;
	if ($fila1==1)
		{
			$reg1 = $conex->result_h;
			$reg2 = $conex->result[0];
			$reg = array_combine($reg1,$reg2);
	
    ?>
	<form name="Solicitud" action="actualizarlisto.php" method="post" onSubmit="return validar(this)">
	    <table border="0px" width="600" align="center">
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
				    <p class="titulon">ASIGNATURA <?php if($_REQUEST['as']==1){printf('PR&Aacute;CTICA PROFESIONAL');}else{printf('TRABAJO DE GRADO');}?></font>
				</td>
				<?php
				printf('<td><input type="hidden" name="TIPO_PASANTIA" value="%s"></td>',$_REQUEST["as"]);
				?>
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
				    printf('<tr>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td>
					<td <div class="datosp">%s</div></td></tr>',$reg["APELLIDOS"],$reg["NOMBRES"],$_REQUEST["id"]);
				?>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp"><B>Expediente:</B></div></td>
				    <td bgcolor="#FFFFFF" colspan="3"><div class="datosp"><B>Especialidad:</B></div>
				    </td>
				</tr>
				<?php
				$sql1="select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'";
				$conex -> ExecSQL($sql1,__LINE__,true);
			        $fila = $conex->filas;
				if ($fila!=0)
				    {
				    $esp1 = $conex->result_h;
				    $esp2 = $conex->result[0];
				    $espe = array_combine($esp1,$esp2);
				        printf('<tr>
					       
					        <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
					        <td bgcolor="#FFFFFF"><div class="datosp"> %s</div></td>
						<td><input type="hidden" name="especialidad" value="%s"></td>
						<td><input type="hidden" name="CI_E" value="%s"></td></tr>', $reg["EXP_E"], $espe["CARRERA"],$reg["C_UNI_CA"],$_REQUEST["id"]);
				    }
				$especialidad=$reg['C_UNI_CA'];
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>
		<?php
		if(/*$especialidad!='5' &&*/ $_REQUEST['as']==2)
		{
		    $sql1="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'";
		    $conex -> ExecSQL($sql1,__LINE__,true);
		    $fila1 = $conex->filas;
		    if ($fila1==1)
		    {	$solicit1 = $conex1->result_h;
			$solicit2 = $conex1->result[0];
			$solicit = array_combine($solicit1,$solicit2);
			
			$sql="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'";
			$conex -> ExecSQL($sql,__LINE__,true);
			$fila2 = $conex->filas;
			if ($fila2==1)
			{
			    $empre1 = $conex1->result_h;
			    $empre2 = $conex1->result[0];
			    $empre = array_combine($empre1,$empre2);
			
			    if($solicit['EXP_E']=="" || $solicit['TIPO_PASANTIA']!="2" || $solicit['ID_EMPRESA']=="")
			    {
				echo ("NO ESTA REGISTRADO EN EL DEPARTAMENTO DE ENTRENAMIENTO INDUSTRIAL");
			    }
			    else
			    {
		?>
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
				    <td style="text-align: center;" class="datosp">
				<tr>
				    <?php
				    printf('
				    <td bgcolor="#FFFFFF"><div  style="text-align:center;" class="datosp">%s</div></td>', $empre["NOMBRE_EMPRESA"]);
					    $empresa=$empre["NOMBRE_EMPRESA"];
					    $_SESSION['empresa']=$empresa;
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    	    }
			}
		    }
		}
		if($_REQUEST['as']==1)
		{
		    $sql1="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'";
		    $conex -> ExecSQL($sql1,__LINE__,true);
		    $fila1 = $conex->filas;
		    if ($fila1==1)
		    {	$solicit1 = $conex1->result_h;
			$solicit2 = $conex1->result[0];
			$solicit = array_combine($solicit1,$solicit2);
			
			$sql="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'";
			$conex -> ExecSQL($sql,__LINE__,true);
			$fila2 = $conex->filas;
			if ($fila2==1)
			{
			    $empre1 = $conex1->result_h;
			    $empre2 = $conex1->result[0];
			    $empre = array_combine($empre1,$empre2);
			
			    if($solicit['EXP_E']=="" || $solicit['TIPO_PASANTIA']!="1" || $solicit['ID_EMPRESA']=="")
			    {
				echo ("NO ESTA REGISTRADO EN EL DEPARTAMENTO DE ENTRENAMIENTO INDUSTRIAL");
			    }
			    else
			    {
		
		?>
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
				    <td style="text-align: center;" class="datosp">
				<tr>
				    <?php
				    printf('
				    <td bgcolor="#FFFFFF"><div style="text-align:center;" class="datosp">%s</div></td>', $empre["NOMBRE_EMPRESA"]);
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    	    }
			}
		    }
		}
		?>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
    		<?php
		    $sql1="select * from sol_historial where CI_E='$_REQUEST[id]' and TIPO_PASANTIA='$_REQUEST[as]'";

		//echo $sql1;
		    $conex1 -> ExecSQL($sql1,__LINE__,true);
		    $fila1 = $conex1->filas;
		    if ($fila1!=0)
		    {	$tab1 = $conex1->result_h;
			$tab2 = $conex1->result[0];
			$tab = array_combine($tab1,$tab2);

			//print_r($tab);
		
		?>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td width="60%" style="text-align: center;" class="datosp">
					<strong>Nombre del Proyecto:</strong>
				    </td>
				</tr>
				<?php
				printf('
				<tr>
				    <td style="text-align: center;" class="datosp">%s</td>
				</tr>',$tab["N_PROYECTO"]);
				?>
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
				    <td width="33%" style="text-align: center;" class="datosp">
					<strong>Fecha de Inicio:</strong>
				    </td>
				    <td width="33%" style="text-align: center;" class="datosp">
					<strong>Fecha de Culminación:</strong>
				    </td>
				    <td width="33%" style="text-align: center;" class="datosp">
					<strong>Fecha de Límite:</strong>
				    </td>
				</tr>
				<?php
				printf('<tr colspan="5">
				    <td class="datosp" style="text-align:center;">%s
				    </td>
				    <td class="datosp" style="text-align:center;">%s
				    </td>
				    <td class="datosp" style="text-align:center;">%s
				    </td>
				</tr>',$tab["FECHA_I"],$tab["FECHA_C"],$tab["FECHA_L"]);
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td align="center" bgcolor="#FFFFFF" colspan="5"><div class="datosc"><B>Estado de Solicitud:</B></div></td></tr>
		<tr>
		    <td class="datosc" style="text-align:center">
		<?php
		$sql1="select estatus from sol_estatus where id_estatus='$tab[ID_ESTATUS]'";

		    $conex1 -> ExecSQL($sql1,__LINE__,true);
		    $fila1 = $conex1->filas;
		    if ($fila1!=0)
		    {	$res1 = $conex1->result_h;
			$res2 = $conex1->result[0];
			$res = array_combine($res1,$res2);
			
		printf('<tr colspan="5">
			<td class="datosp" style="text-align:center;">%s</td>
			</tr>',$res["estatus"]);
		    
		}
		//if($especialidad!=5 || ($especialidad==5 && $_REQUEST['as']==1))
		if (true)
		{
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL TUTOR INDUSTRIAL</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<?php
				printf('
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
				</tr>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Teléfono:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosp"><B>Correo:</B></div></td>
				</tr>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
				    <td bgcolor="#FFFFFF"><div class="datosp">%s</div></td>
				</tr>',$tab["APELLIDO_TI"],$tab["NOMBRE_TI"],$tab["CEDULA_TI"],$tab["TELEFONO_TI"],$tab["CORREO_TI"]);
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		}
			if($tab['CEDULA_TA']!='')
		{
		$sql1="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[CEDULA_TA]";

		//echo $sql1;

		$conex -> ExecSQL($sql1,__LINE__,true);
		    $fila8 = $conex->filas;
		    if($fila8!=0)
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
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				</tr>
				<tr>
				<?php
				printf('
					<td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					',$tab["CEDULA_TA"]);
					
				    $sql="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[CEDULA_TA]" ;
				    $conex -> ExecSQL($sql,__LINE__,true);
				    $fila = $conex->filas;
				    if ($fila==1)
				    {	$prof1 = $conex->result_h;
					$prof2 = $conex->result[0];
					$prof = array_combine($prof1,$prof2);
					
					printf('
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>			      
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					    ',$prof["APELLIDO"],$prof["NOMBRE"]);
				    }
				?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    }
		}
		if($tab['CEDULA_JC']!='')
		{
		$sql1="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[CEDULA_JC]";
		$conex -> ExecSQL($sql1,__LINE__,true);
		    $fila = $conex->filas;
		    if ($fila==1)
				    {	$prof1 = $conex->result_h;
					$prof2 = $conex->result[0];
					$prof = array_combine($prof1,$prof2);
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL JURADO COORDINADOR</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				</tr>
				<tr>
				<?php
				printf('
					<td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					',$tab["CEDULA_JC"]);
					printf('
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>			      
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					    ',$prof["APELLIDO"],$prof["NOMBRE"]);
				    
				?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    }
		}
		if($tab['CEDULA_JS']!='')
		{
		    $sql="select APELLIDO, NOMBRE from tblaca007 where CI = '$tab[CEDULA_JS]'";
		    $conex -> ExecSQL($sql,__LINE__,true);
		    $fila = $conex->filas;
		    if ($fila==1)
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
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				</tr>
				<tr>
				<?php
				printf('
					<td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					',$tab["CEDULA_JS"]);
				    
				    $sql="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[CEDULA_JS]";
				    $conex -> ExecSQL($sql,__LINE__,true);
				    $fila = $conex->filas;
				    if ($fila==1)
				    {	$prof1 = $conex->result_h;
					$prof2 = $conex->result[0];
					$prof = array_combine($prof1,$prof2);
				    
					printf('
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>			      
					    <td nowrap="nowrap" bgcolor="#FFFFFF"><div class="datosc">%s</td>
					    ',$prof["APELLIDO"],$prof["NOMBRE"]);
				    }
				?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    }
		}
		    }
		?>
		<tr align=center>
		    <table align="center" border="0" width=40%>
		    <tr>
		    <td align="center" valign="bottom" colspan="1">
			<input type="button" value="Finalizar" name="bexit" onclick="window.close();">
		    </td>
		    </tr>
		    </table>
		</tr>
	    </table>
	</form>
    <?php
		}
    ?>
</body>
</html>
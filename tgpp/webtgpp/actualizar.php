<?php
if (substr($_SERVER['HTTP_REFERER'],-14) != 'buscadorV1.php' ) {
	die ("<script languaje=\"javascript\"> alert('ACCESO NO VALIDO.'); </script>");
}

session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script language='javascript' src='js/popcalendar.js'></script>
    <script type="text/javascript" src="js/autocomplet2.js"></script>
    <script type="text/javascript" src="js/autocomplet3.js"></script>
    <script type="text/javascript" src="js/autocomplet4.js"></script>
    <script type="text/javascript" src="js/validar.js"></script>
    <title>Actualizar Registros</title>
    <script language=javascript>
    function tutor(){
    document.getElementById('cedula_DS').value  = document.getElementById('cedula_TA').value
   }
    </script> 
</head>
<body>
    <?php
	$_SESSION['coor']=$_SESSION['coor'];
	include_once('conexion.php');
	$sql="select APELLIDOS, NOMBRES, EXP_E, C_UNI_CA, TELEFONO2 from dace002 where CI_E = '$_REQUEST[id]'";
	$conex -> ExecSQL($sql,__LINE__,true);
	$fila = $conex->filas;
	$j=0;
	//while ($j<$fila)
	{
	    $reg1 = $conex->result_h;
	    $reg2 = $conex->result[$j];
	    $reg = array_combine($reg1,$reg2);

		
    ?>
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
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulon">ASIGNATURA <?php if($_REQUEST['as']==1){printf('PR&Aacute;CTICA PROFESIONAL');}else{printf('TRABAJO DE GRADO');}?></font>
				</td>
				<?php
				printf('<td><input type="hidden" name="TIPO_PASANTIA" value="%s"></td>',$_REQUEST["as"]);
				echo "<input type=\"hidden\" name=\"exp_e\" value=\"".$reg["EXP_E"]."\">";
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
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				</tr>
				<?php
				    printf('<tr>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td>
					<td <div class="datosc">%s</div></td></tr>',$reg["APELLIDOS"],$reg["NOMBRES"],$_REQUEST["id"]);
				?>
				<tr>
				    <td bgcolor="#FFFFFF"><div class="datosc"><B>Expediente:</B></div></td>
				    <td bgcolor="#FFFFFF"><div class="datosc"><B>Especialidad:</B></div>
				    <td bgcolor="#FFFFFF" colspan="3"><div class="datosc"><B>Teléfono:</B></div>
				    </td>
				</tr>
				<?php
				    $sql2="select CARRERA from tblaca010 where C_UNI_CA= '$reg[C_UNI_CA]'";
				    $conex -> ExecSQL($sql2,__LINE__,true);
				    $espe1 = $conex->result_h;
				    $espe2 = $conex->result[$j];
				    $espe = array_combine($espe1,$espe2);
					    printf('<tr>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
					        <td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
						<td bgcolor="#FFFFFF"><div class="datosc">%s</div></td>
						<td><input type="hidden" name="especialidad" value="%s"></td>
						<td><input type="hidden" name="CI_E" value="%s"></td></tr>', $reg["EXP_E"],$espe["CARRERA"],$reg["TELEFONO2"],$reg["C_UNI_CA"],$_REQUEST["id"]);
				$especialidad=$reg['C_UNI_CA'];
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5"><font style="font-size:5px;">&nbsp;</font></td></tr>
		<?php
		/*if($especialidad!=5 && $_REQUEST['as']==2)
		{ */  
			$sql3="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='2'  AND TIPO_SOLICITUD='2' ";

		    $conex -> ExecSQL($sql3,__LINE__,true);
		    $solicit1 = $conex->result_h;
		    $solicit2 = $conex->result[0];
		    $solicit = array_combine($solicit1,$solicit2);

			//print_r($solicit);

			$sql4="select NOMBRE_EMPRESA from sol_empresas where ID_EMPRESA= '$solicit[ID_EMPRESA]'";
		    $conex -> ExecSQL($sql4,__LINE__,true);
		    $empre1 = $conex->result_h;
		    $empre2 = $conex->result[0];
		    $empre = array_combine($empre1,$empre2);
		    
			    if($solicit['EXP_E']=="" || $solicit['TIPO_PASANTIA']!="2" || $solicit['ID_EMPRESA']=="")
			    {
				//echo ("NO ESTA REGISTRADO EN EL DEPARTAMENTO DE ENTRENAMIENTO INDUSTRIAL");
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
		//} // Fin buscar empresa
		/*if($_REQUEST['as']==1)// Si es practica profesional
		{   $sql3="select * from sol_solicitudes where EXP_E= '$reg[EXP_E]' and TIPO_PASANTIA='1' AND TIPO_SOLICITUD='2' ";
		    $conex -> ExecSQL($sql3,__LINE__,true);
		    $solicit1 = $conex->result_h;
		    $solicit2 = $conex->result[0];
		    $solicit = array_combine($solicit1,$solicit2);
		    $sql4="select NOMBRE_EMPRESA from sol_empresas where ID_EMPRESA= '$solicit[ID_EMPRESA]'";
		    $conex -> ExecSQL($sql4,__LINE__,true);
		    $empre1 = $conex->result_h;
		    $empre2 = $conex->result[0];
		    $empre = array_combine($empre1,$empre2);
			    if($solicit['EXP_E']=="" || $solicit['TIPO_PASANTIA']!="1" || $solicit['ID_EMPRESA']=="")
			    {
				//echo ("NO ESTA REGISTRADO EN EL DEPARTAMENTO DE ENTRENAMIENTO INDUSTRIAL");
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
					<strong>Empresa:</strong>
				    </td>
				</tr>
				<tr>
				    <td style="text-align: center;" class="datosp">
				<tr>
				    <?
				    printf('
				    <td bgcolor="#FFFFFF"><div style="text-align:center;" class="datosp">%s</div></td>', $empre["NOMBRE_EMPRESA"]);
					    $empresa=$empre["NOMBRE_EMPRESA"];
					    $_SESSION['empresa']=$empresa;
				    ?>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?
		    	    }
		}*/
		?>
		<tr><td colspan="5"><font style="font-size: 5px;">&nbsp;</font></td></tr>
    		<?php
		$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, fecha_l, id_estatus, cedula_TA, cedula_JS, cedula_JC from sol_tgpp where CI_E='$_REQUEST[id]' and TIPO_PASANTIA='$_REQUEST[as]'";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
		    $tab1 = $conex1->result_h;
		    $tab2 = $conex1->result[0];
		    $tab = array_combine($tab1,$tab2);

		$_REQUEST['st'] = $tab['id_estatus'];

		if (($tab['id_estatus']==1) || ($tab['id_estatus']==2)) {
		?>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td width="60%" style="text-align: center;" class="datosp">
					<strong>Titulo del Proyecto:</strong>
				    </td>
				</tr>
				<tr>
					<td style="text-align: center;" class="datosp">
					<textarea name="nom_proyecto" class="datosp" onkeyup="this.value=this.value.toUpperCase();" rows="3" cols="100"><?php echo $tab["n_proyecto"]; ?></textarea><br>
					
				    </td>
				</tr>
				<?php
					/*$oSQL = "SELECT observacion FROM sol_tgpp ";
					$oSQL.= "WHERE ci_e='".$_REQUEST['id']."' AND tipo_pasantia='".$_REQUEST['as']."' ";
					$oSQL.= "AND id_estatus='".$_REQUEST['st']."' ";
					$conex->ExecSQL($oSQL,__LINE__,true);
					if (($conex->filas > 0) && ($_REQUEST['st'] == '2') ){
						$observacion = $conex->result[0][0];
					}*/
					
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
						$fecha_l=$tab['fecha_l'];
						$anio= substr($fecha_l,0,4);
						$mes= substr($fecha_l,5,2);
						$dia= substr($fecha_l,8,2);
						$fecha_l = $dia ."-". $mes ."-". $anio;
				?>
				<tr colspan="5">
				    <td class="datosp" style="text-align:center;">
						<?php 
						printf('
					    <input name="Sel_Fecha1" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival" onClick="popUpCalendar(this, Solicitud.dateArrival, "dd-mm-yyyy");" readonly="" size="10" class="datospf">',$tab["fecha_i"]);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha1, Solicitud.dateArrival, 'dd-mm-yyyy');"> 
				    </td>
				    <td class="datosp" style="text-align:center;">
						<?php 
						printf('
					    <input name="Sel_Fecha" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival1" onClick="popUpCalendar(this, Solicitud.dateArrival1, "dd-mm-yyyy");" readonly="" size="10" class="datospf">',$tab["fecha_c"]);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha, Solicitud.dateArrival1, 'dd-mm-yyyy');">
				    </td>
					<td class="datosp" style="text-align:center;">
						<?php 
						printf('
						<input name="Sel_Fecha2" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival2" onClick="popUpCalendar(this, Solicitud.dateArrival2, "dd-mm-yyyy");" readonly="" size="10" class="datospf">',$fecha_l);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha" onClick="popUpCalendar(document.Solicitud.Sel_Fecha2, Solicitud.dateArrival2, 'dd-mm-yyyy');"> 
				    </td>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td align="center" bgcolor="#FFFFFF" colspan="5"><div class="datosc"><B>Estado de Solicitud:</B></div></td></tr>
		<tr>
		    <td class="datosc" style="text-align:center">
		<?php
		$sql2="select id_estatus, estatus from sol_estatus";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
		$filas = $conex1->filas;
		$j=0;    
		echo "<select name='estatus' id='estatus' class='datosp' onChange='observacion()'>";

		while($j<$filas)
		{
		    $fila = $conex1->result[$j];
		    if ($fila[0]==$_REQUEST['st'])
		    {
			echo "<option selected value='$fila[0]'>$fila[1]";
		    }
		    else
		    {
			echo "<option value='$fila[0]'>$fila[1]";
		    }
		$j++;
		}
		    echo "</select>";
			
		//print_r($_REQUEST);
		
		?>
                    </td>
		</tr>
		<tr><td align="center">
		<?php
			if ($_REQUEST['st'] == '2'){
				
				$sql2="SELECT observacion from sol_tgpp where CI_E='$_REQUEST[id]' and TIPO_PASANTIA='$_REQUEST[as]' and id_estatus='$_REQUEST[st]' ";
				$conex1 -> ExecSQL($sql2,__LINE__,true);
				$obs = $conex1->result[0][0];

				$msgobs = (!empty($obs)) ? "Observacion:": "Describa brevemente la observacion:";
		?>
				<label for="obs" id="lobs" style="font-size:12px;"><?php echo $msgobs; ?></label>
				<textarea name="obs" id="obs" cols="50"><?php echo $obs; ?></textarea>
		<?php
			}
		?>
			
		</td></tr>
		<tr><td align="center">
			<label for="obs" id="lobs" style="display:none;font-size:12px;">Describa brevemente la observacion:</label>
			<textarea name="obs" id="obs" style="display:none;" cols="50"></textarea>
		</td></tr>
		<?php
		if($especialidad!=5 || ($especialidad==5 && $_REQUEST['as']==1))
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
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="apellido_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="nombre_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="cedula_TI" size="25"></td>
				</tr>
				<tr>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Teléfono:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Correo:</B></div></td>
				</tr>
				<tr>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="telefono_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="correo_TI" size="25"></td>
				</tr>',$tab["apellido_TI"],$tab["nombre_TI"],$tab["cedula_TI"],$tab["telefono_TI"],$tab["correo_TI"]);
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		}
		}// Fin estatus = 1 (EN PROCESO)
		else
			{// Para el resto de los estatus
			?>
		<tr>
		    <td width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<tr>
				    <td width="60%" style="text-align: center;" class="datosp">
					<strong>Titulo del Proyecto:</strong>
				    </td>
				</tr>				
				<textarea name="nom_proyecto" class="datosp" onkeyup="this.value=this.value.toUpperCase();" rows="3" cols="100"><?php echo $tab["n_proyecto"]; ?></textarea><br>
				<span style="font-size: 8pt; color: red;">Ahora puede modificar el titulo del proyecto aun cuando el estatus sea APROBADO</span><br><br>
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
						$fecha_l=$tab['fecha_l'];
						$anio= substr($fecha_l,0,4);
						$mes= substr($fecha_l,5,2);
						$dia= substr($fecha_l,8,2);
						$fecha_l = $dia ."-". $mes ."-". $anio;
				?>
				<tr colspan="5">
				    <td class="datosp" style="text-align:center;">
						<?php 
						printf('
					    <input name="Sel_Fecha1" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival" onClick="popUpCalendar(this, Solicitud.dateArrival, "dd-mm-yyyy");" size="10" class="datospf">',$tab["fecha_i"]);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha"> 
				    </td>
				    <td class="datosp" style="text-align:center;">
						<?php 
						printf('
					    <input name="Sel_Fecha" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival1" onClick="popUpCalendar(this, Solicitud.dateArrival1, "dd-mm-yyyy");" size="10" class="datospf">',$tab["fecha_c"]);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha">
				    </td>
					<td class="datosp" style="text-align:center;">
						<?php 
						printf('
						<input name="Sel_Fecha2" value="%s" style="text-align:center; cursor:pointer;" type="text" id="dateArrival2" onClick="popUpCalendar(this, Solicitud.dateArrival2, "dd-mm-yyyy");" readonly="" size="10" class="datospf">',$fecha_l);
						?>
					    <img src="images/cal.jpeg" style="cursor:pointer" width="18" height="15" border="0" alt="Presione para seleccionar una fecha" title="Presione para seleccionar una fecha"> 
				    </td>
				</tr>
			    </tbody>
			</table>
		    </td>
		</tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td align="center" bgcolor="#FFFFFF" colspan="5"><div class="datosc"><B>Estado de Solicitud:</B></div></td></tr>
		<tr>
		    <td class="datosc" style="text-align:center">
		<?php
		$sql2="select id_estatus, estatus from sol_estatus";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
		$filas = $conex1->filas;
		$j=0;    
		//echo "<select name='estatus' id='estatus' class='datosp' onChange='observacion()'>";
		echo "<select name='estatus' id='estatus' class='datosp' onChange='observacion()'";
		echo ">";
		while($j<$filas)
		{
		    $fila = $conex1->result[$j];
		    if ($fila[0]==$_REQUEST['st']) {
				echo "<option selected value='$fila[0]'>$fila[1]";
		    } else{
				if (($_REQUEST['st'] == '3') && ($fila[0] <> '4')){
					// Evita volver de aprobado a "EN PROCESO" y "CON OBSERVACIONES"
					echo "<option disabled value='$fila[0]'>$fila[1]</option>";
				}else{
					echo "<option value='$fila[0]'>$fila[1]</option>";
				}
				
		    }
		$j++;
		}
		    echo "</select>";
		?>
                    </td>
		</tr>
		<tr><td align="center">
		<?php
			if ($_REQUEST['st'] == '2'){
				
				$sql2="SELECT observacion from sol_tgpp where CI_E='$_REQUEST[id]' and TIPO_PASANTIA='$_REQUEST[as]' and id_estatus='$_REQUEST[st]' ";
				$conex1 -> ExecSQL($sql2,__LINE__,true);
				$obs = $conex1->result[0][0];

				$msgobs = (!empty($obs)) ? "Observacion:": "Describa brevemente la observacion::";
		?>
				<label for="obs" id="lobs" style="font-size:12px;"><?php echo $msgobs; ?></label>
				<textarea name="obs" id="obs" cols="50"><?php echo $obs; ?></textarea>
		<?php
			}
		?>
			
		</td></tr>
		<?php
		if($especialidad!=5 || ($especialidad==5 && $_REQUEST['as']==1))
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
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Apellidos:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
				</tr>
				<tr>
				    <td align="center" bgcolor="#FFFFFF"><input type="text"  class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="apellido_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text"  class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="nombre_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text"  class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="cedula_TI" size="25"></td>
				</tr>
				<tr>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Teléfono:</B></div></td>
				    <td align="center" style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Correo:</B></div></td>
				</tr>
				<tr>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="telefono_TI" size="25"></td>
				    <td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="correo_TI" size="25"></td>
				</tr>',$tab["apellido_TI"],$tab["nombre_TI"],$tab["cedula_TI"],$tab["telefono_TI"],$tab["correo_TI"]);
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		}
		}
		if ($tab['id_estatus']==2)
		{
			
		}
		    if($tab['cedula_TA']!="")
		    {
		    ?>
		    <tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td class="enc_p" colspan="5">DATOS DEL TUTOR ACAD&Eacute;MICO</td></tr>
		    <tr align="center">
		        <td colspan="5">
		    	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
		    	    <tbody>
		    		<?php
				    $sql5="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_TA]";
				    $conex -> ExecSQL($sql5,__LINE__,true);
		    		    $prof1 = $conex->result_h;
				    $prof2 = $conex->result[0];
				    $prof = array_combine($prof1,$prof2);
					printf('
					    <tr>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
					    </tr>
					    <tr>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="buscar_usuario" onkeyup="this.value=this.value.toUpperCase();" value="%s %s" name="NOMBRE_APELLIDO" size="45"></td>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="cedula" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="cedula_TA" size="15"></td>
					    </tr>',$prof["NOMBRE"],$prof["APELLIDO"],$tab["cedula_TA"]);
				    
				?>
		    	    </tbody>
		    	</table>
		        </td>
		    </tr>
		<?php
		    }
		    else
		    {
		?>
		    <tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		    <tr><td class="enc_p" colspan="5">DATOS DEL TUTOR ACAD&Eacute;MICO</td></tr>
		    <tr align="center">
		        <td colspan="5">
		    	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
		    	    <tbody>
		    		<tr>
		    		    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
		    		    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
		    		</tr>
		    		<tr>
				    <td align="center"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario" name="buscar_usuario" size="45" /></td>
				    <td align="center"><input type="text" class="datosc" id="cedula" name="cedula_TA" size="15" /></td>
				</tr>
		    	    </tbody>
		    	</table>
		        </td>
		    </tr>
		<?php    
		    }
		    if($tab['cedula_JC']!="")
		    {
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL JURADO COORDINADOR</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<?php
				    $sql5="select APELLIDO, NOMBRE, CI from tblaca007 where CI = $tab[cedula_JC]";
				    $conex -> ExecSQL($sql5,__LINE__,true);
		    		    $prof_1 = $conex->result_h;
				    $prof_2 = $conex->result[0];
				    $prof1 = array_combine($prof_1,$prof_2);
					printf('
					    <tr>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
					    </tr>
					    <tr>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="buscar_usuario_c" onkeyup="this.value=this.value.toUpperCase();" value="%s %s" name="NOMBRE_APELLIDO1" size="45"></td>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="cedula_c" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="cedula_JC" size="15"></td>
					    </tr>',$prof1["NOMBRE"],$prof1["APELLIDO"],$tab["cedula_JC"]);
				    
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    }
		    else
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
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
						</tr>
						<tr>
						    <td class="datosc"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario_c" name="buscar_usuario_c" size="45" /></td>
						    <td align="center"><input type="text" class="datosc" id="cedula_c" name="cedula_JC" size="15" /></td>
						</tr>
				    	    </tbody>
					</table>
				    </td>
				</tr>    
		<?php
		    }
		    if($tab['cedula_JS']!="")
		    {
		?>
		<tr><td colspan="5"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td colspan="5" style="background-color:#99CCFF;"><font style="font-size:2px;">&nbsp;</font></td></tr>
		<tr><td class="enc_p" colspan="5">DATOS DEL JURADO SECRETARIO</td></tr>
		<tr align="center">
		    <td colspan="5">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
			    <tbody>
				<?php
				    $sql1="select APELLIDO, NOMBRE from tblaca007 where CI = '$tab[cedula_JS]'";
				    $conex -> ExecSQL($sql1,__LINE__,true);
		    		    $pro1 = $conex->result_h;
				    $pro2 = $conex->result[0];
				    $prof = array_combine($pro1,$pro2); 
		    		    
					printf('
					    <tr>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						<td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
					    </tr>
					    <tr>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="buscar_usuario_s" onkeyup="this.value=this.value.toUpperCase();" value="%s %s" name="NOMBRE_APELLIDO2" size="45"></td>
						<td align="center" bgcolor="#FFFFFF"><input type="text" class="datosc" id="cedula_s" onkeyup="this.value=this.value.toUpperCase();" value="%s" name="cedula_JS" size="15"></td>
					    </tr>',$prof["NOMBRE"],$prof["APELLIDO"],$tab["cedula_JS"]);
				    
				?>
			    </tbody>
			</table>
		    </td>
		</tr>
		<?php
		    }
		    else
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
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>Nombres:</B></div></td>
						    <td style="width: 200px;" bgcolor="#FFFFFF"><div class="datosc"><B>C&eacute;dula:</B></div></td>
						</tr>
						<tr>
						    <td class="datosc"><input type="text" onkeyup="this.value=this.value.toUpperCase();" class="datosc" id="buscar_usuario_s" name="buscar_usuario_s" size="45" /></td>
						    <td align="center"><input type="text" class="datosc" id="cedula_s" name="cedula_JS" size="15" /></td>
						</tr>
					    </tbody>
					</table>
				    </td>
				</tr>
		<?php
		    }
		
		?>
		<tr><td colspan="5"><font style="font-size:10px;">&nbsp;</font></td></tr>
		<tr class="act">
		    <td valign="middle" style="text-align: center;" colspan="5" class="datosp">
			<br>los cambios realizados serán almacenados en la base de datos<br><br>
		    </td>
		</tr>
		<tr align=center>
		    <table align="center" border="0" width=40%>
		    <tr><td height="40" align="center" valign="bottom" colspan="2">
			<input type="submit" value="Actualizar">
		    </td>
		    <td align="center" valign="bottom" colspan="1">
			<input type="button" value="Finalizar" name="bexit" onclick="window.close();">
		    </td>
		    </tr>
		    </table>
		</tr>
	    </table>
	</form>
    <?php
	$j++;
	}
    ?>
</body>
</html>
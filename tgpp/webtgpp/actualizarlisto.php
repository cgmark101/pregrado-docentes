<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 TransiTIonal//EN">
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <link rel="stylesheet" media="all" type="text/css" href="css/estilos.css" />
    <title>Actualizar Registros</title>
    </style>
	<?php
	include_once('conexion.php');	
	$_SESSION['usuario'];
	$fecha_l=$_POST['Sel_Fecha2'];
	$anio= substr($fecha_l,6,4);
	$mes= substr($fecha_l,3,2);
	$dia= substr($fecha_l,0,2);
	$fecha_l = $anio ."-". $mes ."-". $dia;

/*print_r($_POST);
die();*/
	
	$conex1 -> iniciarTransaccion('Iniciar Transaccion: ');

if (!empty($_POST[estatus])){
	
	$_POST[nom_proyecto] = str_replace("'", "´", $_POST[nom_proyecto]);

	$sql2="UPDATE sol_tgpp SET n_proyecto = '".$_POST[nom_proyecto]."' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA='".$_REQUEST[TIPO_PASANTIA]."'";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET fecha_i = '$_POST[Sel_Fecha1]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	 
	$sql2="UPDATE sol_tgpp SET fecha_c = '$_POST[Sel_Fecha]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET fecha_l = '$fecha_l' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);

	$sql2="UPDATE sol_tgpp SET id_estatus = '$_POST[estatus]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);

	if	($_POST[estatus] == '2'){
		$sql2="UPDATE sol_tgpp SET observacion = '$_POST[obs]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA = $_REQUEST[TIPO_PASANTIA]";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
	}else{
		$sql2="UPDATE sol_tgpp SET observacion = '' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA = $_REQUEST[TIPO_PASANTIA]";
		$conex1 -> ExecSQL($sql2,__LINE__,true);
	}
	
	$sql2="UPDATE sol_tgpp SET cedula_TA = '$_POST[cedula_TA]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);

	if($_REQUEST['especialidad']!=5 || ($_REQUEST['especialidad']==5 && $_REQUEST['TIPO_PASANTIA']!=2))
	{
	$sql2="UPDATE sol_tgpp SET cedula_TI = '$_POST[cedula_TI]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET nombre_TI = '$_POST[nombre_TI]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	 
	$sql2="UPDATE sol_tgpp SET apellido_TI = '$_POST[apellido_TI]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET telefono_TI = '$_POST[telefono_TI]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);

	$sql2="UPDATE sol_tgpp SET correo_TI = '$_POST[correo_TI]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET cedula_TA = '$_POST[cedula_TA]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	}
	
	$sql2="UPDATE sol_tgpp SET cedula_JC = '$_POST[cedula_JC]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);
	
	$sql2="UPDATE sol_tgpp SET cedula_JS = '$_POST[cedula_JS]' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
	$conex1 -> ExecSQL($sql2,__LINE__,true);	

	if($_POST['estatus'] == '4') {
		
		$campos = "ci_e, tipo_pasantia, empresa, n_proyecto, fecha_i, fecha_c, fecha_l, id_estatus, cedula_ta, cedula_ti, nombre_ti, apellido_ti, telefono_ti, correo_ti, cedula_jc, cedula_js, exp_e, c_uni_ca, lapso, programa";


		$sql2 = "SELECT ".$campos." FROM sol_tgpp ";
		$sql2.= "WHERE exp_e='".$_POST['exp_e']."' AND tipo_pasantia='".$_POST[TIPO_PASANTIA]."' AND id_estatus = '4' ";		
		$conex1 -> ExecSQL($sql2,__LINE__,true);

		if ($conex1->filas > 0) {
			$ci_e			= $conex1->result[0][0];
			$tipo_pasantia	= $conex1->result[0][1];
			$empresa		= $conex1->result[0][2];
			$n_proyecto		= $conex1->result[0][3];
			$fecha_i		= $conex1->result[0][4];
			$fecha_c		= $conex1->result[0][5];
			$fecha_l		= $conex1->result[0][6];
			$id_estatus		= $conex1->result[0][7];
			$cedula_ta		= $conex1->result[0][8];
			$cedula_ti		= $conex1->result[0][9];
			$nombre_ti		= $conex1->result[0][10];
			$apellido_ti	= $conex1->result[0][11];
			$telefono_ti	= $conex1->result[0][12];
			$correo_ti		= $conex1->result[0][13];
			$cedula_jc		= $conex1->result[0][14];
			$cedula_js		= $conex1->result[0][15];
			$exp_e			= $conex1->result[0][16];
			$c_uni_ca		= $conex1->result[0][17];
			$lapso			= $conex1->result[0][18];
			$programa		= $conex1->result[0][19];
			
			$sql2 = "INSERT INTO sol_historial (".$campos.") VALUES ('".$ci_e."', '".$tipo_pasantia."', '".$empresa."', '".$n_proyecto."', '".$fecha_i."', '".$fecha_c."', '".$fecha_l."', '".$id_estatus."', '".$cedula_ta."', '".$cedula_ti."', '".$nombre_ti."', '".$apellido_ti."', '".$telefono_ti."', '".$correo_ti."','".$cedula_jc."','".$cedula_js."','".$exp_e."','".$c_uni_ca."','".$lapso."','".$programa."') ";	
			$conex1 -> ExecSQL($sql2,__LINE__,true);

			if ($conex1->fmodif > 0) {// SI lo pasa a hitorico
				$sql2="DELETE FROM sol_tgpp WHERE id_estatus = '4' AND exp_e='".$_POST['exp_e']."' ";
				$conex1 -> ExecSQL($sql2,__LINE__,true);	
			}else {// SI no lo guarda en historico lo vuelvo a aprobado
				$sql2="UPDATE sol_tgpp SET id_estatus = '3' WHERE exp_e='".$_POST['exp_e']."' AND TIPO_PASANTIA =$_REQUEST[TIPO_PASANTIA]";
				$conex1 -> ExecSQL($sql2,__LINE__,true);
			}
		}//FIN SI tiene el estatus culminado en bd
	}//FIN Si el estatus es culminado

	$conex1 -> finalizarTransaccion('Fin Transaccion: ');
}
	?>

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
			            <p class="titulon">UNIVERSIDAD NACIONAL EXPERIMENTAL POLIT&Eacute;CNICA</p>
				    <p class="titulon">"ANTONIO JOS&Eacute; DE SUCRE"</p>
				    <p class="titulon">VICE-RECTORADO PUERTO ORDAZ</font></p>
				    <p class="titulon">ASIGNATURA TRABAJO DE GRADO Y PRÁCTICA PROFESIONAL</font>
				</td>
				<td border="0" width="50">&nbsp;</td>
			    </tr>
			</table>
		    </td>
		</tr>
		<tr>
		<tr><td><span style="font-size:100px;">&nbsp;</span></td></tr>
		</tr>
		<tr>
			<td>
			<div class="tituloc" align=center>Sus datos  se  han modificado exitosamente!<br></div>
			</td>	
		</tr>
		<?php
		$_SESSION["TIPO_PASANTIA"]=$_POST['TIPO_PASANTIA'];
		$_SESSION["CI_E"]=$_POST['CI_E'];
		$_SESSION['coor']=$_SESSION['coor'];
		
		$sql2="select CI_E, empresa, n_proyecto, TIPO_PASANTIA, cedula_TI, nombre_TI, apellido_TI, telefono_TI, correo_TI, fecha_i, fecha_c, id_estatus, cedula_TA, cedula_JC, cedula_JS from sol_tgpp
		where CI_E='$_REQUEST[CI_E]' and TIPO_PASANTIA='$_REQUEST[TIPO_PASANTIA]' and id_estatus='$_REQUEST[estatus]'";
		$conex1 -> ExecSQL($sql2,__LINE__,true);

		$fila1 = $conex1->filas;
		$j=0;
		while ($j<$fila1)
		{
		$conex1 -> ExecSQL($sql2,__LINE__,true);
		$tab1 = $conex1->result_h;
		$tab2 = $conex1->result[$j];
		$tab = array_combine($tab1,$tab2);
		?>
		<tr><td><span style="font-size:100px;">&nbsp;</span></td></tr>		
		<tr>
		    <td>
			<table width="750"  align=center border="1" CELLPADDING=0 CELLSPACING=0 overflow:auto bgcolor="99CCFF">
			    <tr height="20%">
				<?php
				if($tab['cedula_TA']!="") {
				?>
					<td width="20%" scope="col"><span class="datosp">Carta Tutor Acad.</span></td>
					<?php
					if($tab['cedula_JS']!="" && $tab['cedula_JC']!="") {
					?>
						<td width="20%" scope="col"><span class="datosp">Carta Jurado Coordinador</span></td>
						<td width="20%" scope="col"><span class="datosp">Carta Jurado Secretario</span></td>
					<?php
					}
					?>
				<?php
				}
				?>
				</tr>
				<tr>
				<?php
				if($tab['cedula_TA']!="") {
					printf('<td><center><a href="carta_tutor_a.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
					if($tab['cedula_JC']!="" && $tab['cedula_JS']!="") {
						printf('<td><center><a href="carta_jurado_c.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>
							<td><center><a href="carta_jurado_s.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>
							',$_REQUEST['CI_E'],$_REQUEST['CI_E']);
						
						$sql1="select NOMBRES, APELLIDOS, C_UNI_CA from dace002 where CI_E = '$_REQUEST[CI_E]'";
						$conex -> ExecSQL($sql1,__LINE__,true);
						$fila = $conex->filas;
						$reg1 = $conex->result_h;
						$reg2 = $conex->result[0];
						$esp = array_combine($reg1,$reg2);
						
					}
				}
		$j++;
		}
			?>
		</tr>
		</table><br>
		
		<?php
		if (($fila!=0) and ($_POST['especialidad'] == '2')) {
			
			//print_r($_REQUEST);
			//echo "<td>".$_POST['ci_e']."</td>";
			
		?>
			Modelos de Acta de Evaluacion:
			<table width="750"  align=center border="1" CELLPADDING=0 CELLSPACING=0 bgcolor="99CCFF">
			<tr>
				<td width="20%" scope="col"><span class="datosp">Acta Final</span></td>
				
			</tr>
				<?php
					if ($fila!=0) {
						if($esp['C_UNI_CA'] != 5 || ($esp['C_UNI_CA']== 5 and $tab['TIPO_PASANTIA']==1)) {
							printf('<td><center><a href="acta_final_pp.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
							//printf('<td><center><a href="acta_final_ppeb.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
						} else {
							printf('<td><center><a href="acta_final_tg.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);							
						}
					}					
				?>
			<tr>
				<td width="20%" scope="col"><span class="datosp">Acta Final Sin Tutor Industrial</span></td>
				
			</tr>
			<tr>
				<?php
					printf('<td><center><a href="acta_final_pp_ti.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
					//printf('<td><center><a href="acta_final_pp_eb.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
				?>
			</tr>
			
			
			</table>
		<?php
		} else {
		?>
			
			<table width="750"  align=center border="1" CELLPADDING=0 CELLSPACING=0 bgcolor="99CCFF">
			<tr>
				<td width="20%" scope="col"><span class="datosp">Acta Final de Evaluacion</span></td>
			</tr>
				<?php
					if ($fila!=0) {
						if($esp['C_UNI_CA'] != 5 || ($esp['C_UNI_CA']== 5 and $tab['TIPO_PASANTIA']==1)) {
							printf('<td><center><a href="acta_final_pp.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
							//printf('<td><center><a href="acta_final_ppeb.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);
						} else {
							printf('<td><center><a href="acta_final_tg.php?id=%s" target="_blank"><img src="imagenes/impresora02.gif" alt="imprimir" width="40"height="40" border="0"></a></center></td>',$_REQUEST['CI_E']);							
						}
					}					
				?>
			<tr>
		<?php
		}
		?>
		
		
		
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

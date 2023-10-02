<?php
session_start();
error_reporting(E_ALL);
include_once('inc/config.php'); 
require_once('inc/odbcss_c.php');
$ced=$_POST['ced'];



$conex = new ODBC_Conn($ODBC_user,$usuario_user,$password_user,true,$log);
$dSQL = "SELECT tipo_usuario FROM usuarios WHERE userid='$ced' ";
$dSQL.= "AND tipo_usuario IN ('21','22','31','32','41','42','51','52','61','62','75','700') ";
$conex->ExecSQL($dSQL,__LINE__,true);

if ($conex->filas == 1){ // Si es docente, entrenamiento o serv. comun.
	$tipo_usuario = $conex->result[0][0];
	$_SESSION["user"] = $tipo_usuario;
	$_SESSION["ced"] = "$ced";
	/*echo $_SESSION["user"];
	echo '<br />';
	echo $_SESSION["ced"];*/

	header('Location: index_0.php');
} else {
	$conex = new ODBC_Conn("USUARIOS",$usuario_user,$password_user,true,$log);
	$uSQL = "SELECT tipo_usuario FROM usuarios WHERE exp_e='$ced' AND tipo_usuario IN ('800','1510')";
	$conex->ExecSQL($uSQL,__LINE__,true);
	
	if ($conex->filas == 1) {// Si es URACE
		$tipo_usuario = $conex->result[0][0];
	
		/*echo $tipo_usuario;
		die();*/

		$_SESSION["user"] = '0';
		$_SESSION["ced"] = "$ced";
		//echo $_SESSION["user"];
		//echo '<br />';
		//echo $_SESSION["ced"];

		header('Location: index_0.php');	
	} else {
		echo '
		<link rel="stylesheet" href= "css/estilo.css"  type="text/css" media="screen">
		<table width="720" border="0" align="center" style="border-collapse: collapse;border-color:black;">
			<tr>
				<td class="titulo_tabla"><div align="left">Sugerencias:</div></td>
			</tr>
			<tr>
				<td class="datospd">
					<div align="left">
						<span class="alert2">
							No se encontró usuario con el Nro de Cédula
						</span>
					</div>
				</td>
			</tr>
		</table>';
		echo "
		<script languaje='javascript'>
			alert('ALERTA: No se encontró usuario con el Nro de Cédula');
			window.close();
		</script>";

	}
} 

?>
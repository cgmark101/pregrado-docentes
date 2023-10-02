<?php
include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

if (isset($_POST['agrega'])){
	$total_ag = count($_POST)-4;
	if (($_POST['agrega'] == 'si') and ($total_ag > 0)){
		echo "script para capturar los expedientes <BR>";
		$acta = $_POST['acta'];
		$seccion = $_POST['seccion'];
		$c_asigna = $_POST['c_asigna'];
		echo $total_ag."<BR>".$acta."<BR>".$seccion."<BR>".$c_asigna;
		/*print_r($_POST);
		echo $lapsoProceso;
		echo count($_POST)-4;
		echo $_POST['agrega'];*/

		#aumentar el total de cupos en TBLACA004
		/*$Cnot = new ODBC_Conn("DACEPOZ","N","N",$ODBCC_conBitacora, $laBitacora);
		$mSQL = "UPDATE TBLACA004 SET tot_cup";
		//$mSQL= $mSQL." ";
		$mSQL= $mSQL." VALUES  ('$nota','$acta','$cod','$exp','$lapsoProceso', ";
		$mSQL= $mSQL."'$estatus','$statusr','$afecind')";
		$Cnot->ExecSQL($mSQL,__LINE__,true);*/


	}else echo "no agrega";
}
?>
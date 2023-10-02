<?php //Generador de Nros de Actas
error_reporting(E_ALL);
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
require('funciones.php');

//$lap = $_POST['lap']."-".$_POST['so'];

//consulta Nro de acta mayor en his_act
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(his_act)) FROM his_act WHERE his_lap='$lap'";
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m1=$result[0][0];

//echo $acta_m1;

//incializo sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
//$mSQL  = "UPDATE sc_temp1 SET acta='$acta_m1'";     
$conex->ExecSQL($mSQL,__LINE__,true);

//consulto Nro de acta mayor en tblaca004
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(ACTA)) FROM TBLACA004 WHERE LAPSO='$lap'";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m2=$result[0][0];

//consulto Nro de acta mayor en sc_temp1
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "SELECT MAX(@VALUE(acta)) FROM sc_temp1";     
$conex->ExecSQL($mSQL,__LINE__,false);
$result = $conex->result;
$fila = $conex->filas;
$acta_m3=$result[0][0];

$nacta = generar_acta($acta_m1,$acta_m2,$acta_m3);

//ingreso el Nro nuevo de acta en sc_temp1
/*$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "UPDATE sc_temp1 SET acta='$nacta' WHERE ci='".$_SESSION['ced']."' "; 

$conex->ExecSQL($mSQL,__LINE__,true);*/

//ingreso el numero de acta generado en sc_temp1
	$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
	$mSQL = "INSERT INTO sc_temp1 (acta,ci,lapso,c_asigna) ";
	$mSQL.= "VALUES ('$nacta','".$_SESSION['ced']."','".$lap."','000000')";
	$conex->ExecSQL($mSQL,__LINE__,true);
	$ok=$conex->fmodif;


//echo $nacta;

?>
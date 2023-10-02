<?php header( 'Content-type: text/html; charset=iso-8859-1' );



include('encabezado.php');
include_once('inc/config.php');
require_once('inc/odbcss_c.php');
//require("funciones.php");
//$ci_e = getParam($_GET["id"], "-1");
//$action = getParam($_GET["action"], "");

$ci_e=$_GET['id'];
$action=$_GET['action'];
 
if ($action == "del") {
$conex->iniciarTransaccion("Inicia Transaccion ".$_SESSION['ced']);
$conex = new ODBC_Conn($ODBC_name,$usuario_db,$password_db,TRUE,$log);
$mSQL  = "DELETE FROM sc_temp WHERE ci_e='$ci_e' ";     
$conex->ExecSQL($mSQL,__LINE__,true);
$conex->finalizarTransaccion("Finaliza Transaccion ".$_SESSION['ced']);
$result = $conex->result;
$fila = $conex->filas;
//header("location: muestra.php");
 include('ing_ced_sc.php');

include('muestra_sc.php');
}

include('pie.php');
?>

